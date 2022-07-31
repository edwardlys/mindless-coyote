<script setup>
import { ref } from "vue";
import axios from "axios";

let username = ref("");
let email = ref("");
let password = ref("");
let confirmPassword = ref("");

const submit = () => {
  // submit registration
};
</script>

<template>
  <div class="center">
    <div>
      <input type="text" placeholder="Username" :model="username" />
    </div>

    <div>
      <input type="email" placeholder="Email" :model="email" />
    </div>

    <div>
      <input type="password" placeholder="Password" :model="password" />
    </div>

    <div>
      <input
        type="password"
        placeholder="Confirm password"
        :model="confirmPassword"
      />
    </div>

    <button type="button" @click="submit">Submit</button>
  </div>
</template>

<style lang="scss" scoped>
div {
  padding: 2px;
}
</style>
