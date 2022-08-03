import { createApp } from "vue";
import App from "./App.vue";
const app = createApp(App);

// Create backend axios instance.
import axios from "axios";

app.provide(
  "$backend",
  axios.create({
    baseURL: import.meta.env.VITE_BACKEND_BASE_URL,
    timeout: 3000,
    withCredentials: true,
    headers: {
      Accept: "application/json",
    },
  })
);
////////////////////

// Icon components.
////////////////////
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  FontAwesomeIcon,
  FontAwesomeLayers,
  FontAwesomeLayersText,
} from "@fortawesome/vue-fontawesome";
import { fas } from "@fortawesome/free-solid-svg-icons";

library.add(fas);
app.component("font-awesome-icon", FontAwesomeIcon);
app.component("font-awesome-layers", FontAwesomeLayers);
app.component("font-awesome-layer-text", FontAwesomeLayersText);
////////////////////

// Create Toast instance.
////////////////////
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
app.use(Toast, {});
////////////////////

// Create Pinia store instance.
////////////////////
import { createPinia } from "pinia";
app.use(createPinia());
////////////////////

// Check authentication before creating router and mounting app.
////////////////////
import { useAuthStore } from "./stores/auth";
import router from "./router";

const authStore = useAuthStore();

authStore.checkAuth().then(() => {
  app.use(router);
  app.mount("#app");
});
////////////////////
