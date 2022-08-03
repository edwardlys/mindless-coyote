import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "Home",
      component: () => import("../views/HomeView.vue"),
    },
    {
      path: "/login",
      name: "Login",
      component: () => import("../views/LoginView.vue"),
      beforeEnter: () => {
        const authStore = useAuthStore();
        return !authStore.isLoggedIn;
      },
    },
    // {
    //   path: "/sign-up",
    //   name: "SignUp",
    //   component: () => import("../views/SignUpView.vue"),
    // },
    {
      path: "/entries",
      name: "Entries",
      component: () => import("../views/Entries/EntryIndex.vue"),
    },
    {
      path: "/entries/:slug",
      name: "EntriesView",
      component: () => import("../views/Entries/EntryView.vue"),
      props: true,
    },
    {
      path: "/entries/create",
      name: "EntriesCreate",
      component: () => import("../views/Entries/EntryForm.vue"),
    },
    {
      path: "/entries/:slug/update",
      name: "EntriesUpdate",
      component: () => import("../views/Entries/EntryForm.vue"),
      props: true,
    },
    // {
    //   path: "/diff",
    //   name: "Diff",
    //   component: () => import("../views/DiffView.vue"),
    // },
  ],
});

export default router;
