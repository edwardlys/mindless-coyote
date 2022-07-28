<script setup>
</script>

<template>
  <div>
    <nav>
      <RouterLink :to="{ name: 'home' }" @click="clickedLink">Home</RouterLink>
      <RouterLink :to="{ name: 'diff' }" @click="clickedLink">Diff</RouterLink>
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
  }

  a:visited {
    color: black;
  }

  a:hover {
    animation: fadeHightlight 0.5s;
    background-color: black;
    color: white;
  }

  a.router-link-active {
    animation: blink 2s;
  }
}

@keyframes fadeHightlight {
  from {
    background-color: white;
    color: black;
    }
  to {
    background-color: black;
    color: white;
    }
}

@keyframes blink {
  0%   {
    background-color: white;
    color: black;
    }
  20%  {
    background-color: black;
    color: white;
    }
  40%  {
    background-color: white;
    color: black;
    }
  60%  {
    background-color: black;
    color: white;
    }
  100% {
    background-color: white;
    color: black;
    }
}
</style>