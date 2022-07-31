<script setup>
import { RouterLink, RouterView } from "vue-router";
import Navbar from "./components/Navbar.vue";
</script>

<template>
  <div>
    <div class="center">
      <h1>Mindless Coyote</h1>
      <span
        >Write things down. Unwind. Nothing to be done. Nothing to worry
        about.</span
      >
    </div>

    <hr />

    <navbar class="center" />

    <RouterView />
  </div>
</template>

<style lang="scss">
@import "./assets/scss/general.scss";
</style>
