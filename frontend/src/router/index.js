import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "Home",
      component: () => import('../views/HomeView.vue'),
    },
    {
      path: "/entries",
      name: "Entries",
      component: () => import('../views/Entries/Index.vue'),
    },
    {
      path: "/entries/:slug",
      name: "EntriesView",
      component: () => import('../views/Entries/View.vue'),
      props: true,
    },
    {
      path: "/entries/create",
      name: "EntriesCreate",
      component: () => import('../views/Entries/Form.vue'),
    },
    {
      path: "/entries/:slug/update",
      name: "EntriesUpdate",
      component: () => import('../views/Entries/Form.vue'),
    },
    {
      path: "/diff",
      name: "Diff",
      component: () => import('../views/DiffView.vue'),
    },
  ],
});

export default router;
