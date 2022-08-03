import { defineStore } from "pinia";
import { useToast } from "vue-toastification";
import axios from "axios";

const backend = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_BASE_URL,
  timeout: 3000,
  withCredentials: true,
  headers: {
    Accept: "application/json",
  },
});
const toast = useToast();

export const useAuthStore = defineStore("auth", {
  state: () => {
    return {
      _isLoggedIn: false,
      _user: null,
    };
  },

  actions: {
    // This has two purposes. Check if user is logged in by fetching user information.
    // If user is logged in, then user information in this store will be populated.
    checkAuth() {
      return backend
        .get("api/user")
        .then((response) => {
          if (response.data.code == "FETCH_USER_SUCCESS") {
            this._isLoggedIn = true;
            this._user = response.data.data.user;
          }
        })
        .catch(() => {
          this._isLoggedIn = false;
          this._user = null;
        });
    },

    // Logs in the user based on the given email and password combination.
    // Also gives the appropriate toasts given the response from the backend.
    async login(email, password) {
      const loginPayload = {
        email: email,
        password: password,
      };

      await backend.get("/sanctum/csrf-cookie");

      return backend
        .post("api/login", loginPayload)
        .then((response) => {
          if (response.data.code == "LOGIN_SUCCESS") {
            this._isLoggedIn = true;
            toast.success("Login successful!");
          } else if (response.data.code == "LOGIN_FAILED_NO_MATCH") {
            this._isLoggedIn = false;
            toast.error("Email/Password invalid. Please try again.");
          } else if (response.data.code == "LOGIN_FAILED_MALFORMED") {
            this._isLoggedIn = false;
            toast.error("Incomplete login request. Please try again.");
          }
        })
        .catch(() => {
          this._isLoggedIn = false;
          toast.error(
            "Unable to initiate login process. Please contact admin."
          );
        });
    },

    // Initiates the log out process.
    logout() {
      return backend
        .post("api/logout")
        .then((response) => {
          if (response.data.code == "LOGOUT_SUCCESS") {
            toast.success("Logout successful!");
            this._isLoggedIn = false;
            this._user = null;
          }
        })
        .catch(() => {
          toast.error(
            "Unable to initiate logout process. Please contact admin."
          );
        });
    },
  },

  getters: {
    user: (state) => state._user,
    isLoggedIn: (state) => state._isLoggedIn,
  },
});
