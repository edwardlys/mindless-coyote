<script setup>
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();
</script>

<template>
  <div class="footer-nav">
    <nav>
      <RouterLink :to="{ name: 'Home' }" custom v-slot="{ navigate }">
        <button @click="navigate">Home</button>
      </RouterLink>

      <RouterLink
        v-if="authStore.isLoggedIn"
        :to="{ name: 'Entries' }"
        custom
        v-slot="{ navigate }"
      >
        <button @click="navigate">Manage Entries</button>
      </RouterLink>
    </nav>
  </div>
</template>

<style lang="scss" scoped>
button {
  margin: 2px;
}

.footer-nav {
  overflow-x: scroll;
  position: fixed;
  padding-bottom: 10px;
  padding-top: 10px;
  bottom: 0;
  width: 100%;
  background: white;
}
</style>
