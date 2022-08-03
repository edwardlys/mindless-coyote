<script setup>
import { RouterView, useRouter } from "vue-router";

import FooterNav from "./components/FooterNav.vue";
import LoginStatus from "./components/LoginStatus.vue";

const router = useRouter();

const goToHome = () => {
  router.push({ name: "Home" });
};
</script>

<template>
  <div>
    <div class="center">
      <h1 @click="goToHome">Mindless Coyote</h1>
    </div>

    <LoginStatus />

    <hr />
    <RouterView />
    <FooterNav />
  </div>
</template>

<style lang="scss">
@import "./assets/scss/general.scss";
</style>

<style lang="scss" scoped>
h1 {
  margin: 0px;
}
</style>
