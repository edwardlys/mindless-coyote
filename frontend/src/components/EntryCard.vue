<script setup>
const props = defineProps({
  title: String,
  content: String,
  date: String,
  slug: String,
});
</script>

<template>
  <div class="card">
    <div class="card-header">
      <h2 class="title">{{ title }}</h2>
      <small class="date">{{ date }}</small>
    </div>
    <div class="card-body">
      <div class="preview" v-html="content"></div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.card {
  border: 1px solid black;
  padding: 2rem;
  margin: 1rem;

  .card-header {
    margin-bottom: 1rem;

    .title {
      margin: 0px;
    }
  }

  .preview {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
  }
}

.card:hover {
  animation: fadeHightlight 0.5s;
  background-color: black;
  color: white;
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
  0% {
    background-color: white;
    color: black;
  }
  20% {
    background-color: black;
    color: white;
  }
  40% {
    background-color: white;
    color: black;
  }
  60% {
    background-color: black;
    color: white;
  }
  100% {
    background-color: white;
    color: black;
  }
}
</style>
