<script setup>
import { useAuthStore } from "../stores/auth";

const authStore = useAuthStore();

const logout = () => {
  if (confirm("Press OK to logout")) {
    authStore.logout();
  }
}
</script>

<template>
  <div class="login-status">
    <div v-if="authStore.isLoggedIn">
      <font-awesome-icon icon="fa-solid fa-plug" @click="logout" :style="{ color: 'green' }"/>
    </div>
    <div v-else>
      <RouterLink :to="{ name: 'Login' }" custom v-slot="{ navigate }">
        <font-awesome-layers @click="navigate">
          <font-awesome-icon icon="fa-solid fa-plug" />
          <font-awesome-icon
            icon="fa-solid fa-xmark"
            transform="grow-6"
            :style="{ color: 'red' }"
          />
        </font-awesome-layers>
      </RouterLink>
      
    </div>
  </div>
</template>

<style lang="scss" scoped>
.login-status {
  position: absolute;
  right: 0px;
  top: 0px;
  margin: 0.5rem;
}
</style>
