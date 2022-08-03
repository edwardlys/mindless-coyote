<script setup>
import { ref, onMounted } from "vue";
import { useAuthStore } from "../../stores/auth";
import { useRouter } from "vue-router";

const email = ref("");
const password = ref("");
const authStore = useAuthStore();
const router = useRouter();

const emailFieldInput = ref(null);

const submit = () => {
  authStore.login(email.value, password.value).then((r) => {
    router.push({ name: 'Home' });
  });
};

onMounted(() => {
  emailFieldInput.value.focus();
});
</script>

<template>
  <div class="center">
    <form @submit.prevent="submit">
      <div>
        <input type="email" placeholder="Email" v-model="email" ref="emailFieldInput"/>
      </div>

      <div>
        <input type="password" placeholder="Password" v-model="password" />
      </div>

      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<style lang="scss" scoped>
div {
  padding: 2px;
}
</style>
