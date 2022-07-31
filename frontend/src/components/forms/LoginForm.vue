<script setup>
import { ref } from "vue";
import axios from "axios";

const BACKEND_API_BASE_URL = import.meta.env.VITE_BACKEND_API_BASE_URL;

const email = ref("");
const password = ref("");

const testAxios = axios.create({
  withCredentials: true,
});

const submit = () => {
  testAxios.get(`http://localhost:8020/sanctum/csrf-cookie`).then((response) => {
    testAxios
      .post(`${BACKEND_API_BASE_URL}/differ`, {
        oldContent: email.value,
        newContent: password.value,
      })
      .then((response) => {
        console.log("================");
        console.log(response);
        console.log("================");
      });

    // testAxios
    //   .post(`${BACKEND_API_BASE_URL}/login`, {
    //     email: email.value,
    //     password: password.value,
    //   })
    //   .then((response) => {
    //     if (response.data.code == "LOGIN_SUCCESS") {
    //       alert("Successfully logged in");

    //       testAxios
    //         .post(`${BACKEND_API_BASE_URL}/differ`, {
    //           oldContent: email.value,
    //           newContent: password.value,
    //         })
    //         .then((response) => {
    //           console.log("================");
    //           console.log(response);
    //           console.log("================");
    //         });
    //     } else {
    //       alert("Error logged in");
    //     }
    //   });
  });
};
</script>

<template>
  <div class="center">
    <div>
      <input type="email" placeholder="Email" v-model="email" />
    </div>

    <div>
      <input type="password" placeholder="Password" v-model="password" />
    </div>

    <button type="button" @click="submit">Submit</button>
  </div>
</template>

<style lang="scss" scoped>
div {
  padding: 2px;
}
</style>
