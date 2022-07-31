<script setup></script>

<template>
  <div>
    <nav>
      <RouterLink :to="{ name: 'Home' }">Home</RouterLink>
      <RouterLink :to="{ name: 'Login' }">Login</RouterLink>
      <RouterLink :to="{ name: 'SignUp' }">Sign-up</RouterLink>
      <RouterLink :to="{ name: 'Diff' }">Diff</RouterLink>
      <RouterLink :to="{ name: 'Entries' }">Entries</RouterLink>
    </nav>
  </div>
</template>

<style lang="scss" scoped>
nav {
  a {
    margin: 2px;
    border: 1px solid;
    text-decoration: none;
    font-size: 1.5rem;
    color: black;
  }

  a:visited {
    color: black;
  }

  a:hover {
    animation: fadeHightlight 0.5s;
    background-color: black;
    color: white;
  }
}
</style>
