<template>
  <div
    class="d-flex justify-content-center align-items-center flex-column min-vh-100"
  >
    <div v-if="validate == true" class="alert alert-danger" role="alert">
      Name atau Password salah
    </div>

    <div class="card">
      <div class="card-body">
        <h3 class="text-center my-3">Login</h3>
        <form @submit.prevent="doLogin">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              v-model="data.name"
            />
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label"
              >Password</label
            >
            <input
              type="password"
              class="form-control"
              id="exampleInputPassword1"
              v-model="data.password"
            />
          </div>
          <div class="mb-3">
            <router-link :to="{ name: 'blog.register' }"
              >Belum punya akun?</router-link
            >
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import router from "../routes";
export default {
  data() {
    return {
      data: [],
      validate: false,
    };
  },

  methods: {
    doLogin() {
      axios
        .post("http://127.0.0.1:8000/api/auth/login", {
          name: this.data.name,
          password: this.data.password,
        })
        .then((res) => {
          console.log(res);
          localStorage.setItem("users", JSON.stringify(res.data));
          router.push("/dashboard");
        })
        .catch((err) => {
          console.log(err);
          this.validate = true;
        });
    },
  },
};

let loggedIn = JSON.parse(localStorage.getItem("users"));
if (loggedIn != null) {
  router.push("/dashboard");
}
</script>
