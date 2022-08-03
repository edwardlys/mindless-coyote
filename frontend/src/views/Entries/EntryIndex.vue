<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import EntryCard from "../../components/EntryCard.vue";
import { useRouter } from "vue-router";

let entries = ref([]);

onMounted(() => {
  // Getting a list of entries.
  axios.get("http://localhost:8020/api/entries").then((response) => {
    if (response.data.code == "ENTRY_RETRIEVED") {
      entries.value = response.data.data.entries;
    } else {
      alert("Error retrieving entries");
    }
  });
});

const router = useRouter();

const goToCreateEntryPage = () => {
  router.push({ name: "EntriesCreate" });
};

const goToUpdateEntryPage = (slug) => {
  router.push({ name: "EntriesUpdate", params: { slug } });
};
</script>

<template>
  <div>
    <div class="create-button">
      <button @click="goToCreateEntryPage">Create a new entry</button>
    </div>

    <div v-for="(entry, index) in entries" :key="index">
      <EntryCard
        @click="goToUpdateEntryPage(entry.slug)"
        :title="entry.title"
        :content="entry.content"
        :date="entry.created_at"
        :slug="entry.slug"
      >
      </EntryCard>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.create-button {
  text-align: center;
}
</style>