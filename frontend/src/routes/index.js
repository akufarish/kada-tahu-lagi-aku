import { createWebHistory, createRouter } from "vue-router";

const routes = [
  {
    path: "/",
    name: "blog.login",
    component: () => import("../pages/login.vue"),
  },
  {
    path: "/register",
    name: "blog.register",
    component: () => import("../pages/register.vue"),
  },
  {
    path: "/dashboard",
    name: "blog.dashboard",
    component: () => import("../pages/dashboard.vue"),
  },
  {
    path: "/single/:id",
    name: "blog.single",
    component: () => import("../pages/single.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
