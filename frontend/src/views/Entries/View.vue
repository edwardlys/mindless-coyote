<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import EntryCard from "../../components/EntryCard.vue";

const props = defineProps({
  slug: String,
});

let entry = ref([]);

onMounted(() => {
  // Getting a list of entries.
  axios
    .get(`http://localhost:8020/api/entries/${props.slug}`)
    .then((response) => {
      if (response.data.code == "ENTRY_RETRIEVED") {
        entry.value = response.data.data.entry;
      } else {
        alert("Error retrieving entries");
      }
    });
});
</script>

<template>
  <div>
    <h2>{{ entry.title }}</h2>

    <div v-html="entry.content"></div>
  </div>
</template>
