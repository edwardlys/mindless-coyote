<script setup>
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <div class="wrapper">
    <nav>
      <RouterLink :to="{ name: 'home' }">Home</RouterLink>
      <RouterLink :to="{ name: 'map' }">Map</RouterLink>
      <RouterLink :to="{ name: 'gps' }">Gps</RouterLink>
    </nav>
  </div>

  <RouterView />
</template>
