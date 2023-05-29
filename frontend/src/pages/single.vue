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
          <a class="nav-link" href="#">{{ user.data.name }}</a>
          <a href=""></a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container my-5">
    <div class="row">
      <div class="col-3">
        <div class="card my-3">
          <div class="card-body">
            <h1>{{ post.judul }}</h1>
            <p>
              {{ post.slug }}
            </p>
            <p>{{ post.isi }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

let loggedIn = JSON.parse(localStorage.getItem("users"));

export default {
  data() {
    return {
      user: JSON.parse(localStorage.getItem("users")),
    };
  },

  setup() {
    let post = ref([]);
    let route = useRoute();
    onMounted(() => {
      axios
        .get(
          `http://127.0.0.1:8000/api/post/${route.params.id}/?tokens=${loggedIn.data.tokens}`
        )
        .then((res) => {
          console.log(res);
          post.value = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    });
    return {
      post,
    };
  },
};
</script>

<style></style>
