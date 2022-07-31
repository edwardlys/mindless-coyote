<script setup>
import { RouterView } from "vue-router";
import NavBar from "./components/NavBar.vue";
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

    <NavBar class="center" />

    <RouterView />
  </div>
</template>

<style lang="scss">
@import "./assets/scss/general.scss";
</style>
