<template>
  <nav class="navbar navbar-expand-lg bg-primary-subtle">
    <div class="container">
      <router-link class="navbar-brand" :to="{ name: 'blog.dashboard' }"
        >Blog</router-link
      >

      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link" @click="doLogout">{{ users.data.name }}</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container my-5">
    <div class="row">
      <div class="col-3" v-for="(post, index) in posts" :key="index">
        <div class="card my-3">
          <div class="card-body">
            <router-link
              :to="{ name: 'blog.single', params: { id: post.id } }"
              class="text-body-secondary"
            >
              {{ post.judul }}
            </router-link>
            <p>
              {{ post.slug }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import router from "../routes";
import axios from "axios";
export default {
  data() {
    return {
      users: JSON.parse(localStorage.getItem("users")),
    };
  },

  methods: {
    doLogout() {
      localStorage.clear();
      router.push("/");
    },
  },

  setup() {
    let posts = ref([]);
    onMounted(() => {
      axios
        .get(
          `http://127.0.0.1:8000/api/post/all/?tokens=${loggedIn.data.tokens}`
        )
        .then((res) => {
          console.log(res);
          posts.value = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    });
    return {
      posts,
    };
  },
};

let loggedIn = JSON.parse(localStorage.getItem("users"));
if (loggedIn === null) {
  router.push("/");
}
</script>
