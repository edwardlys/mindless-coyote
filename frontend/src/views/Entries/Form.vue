<script setup>
import { ref, computed } from "vue";
import TinyMce from "@tinymce/tinymce-vue";
import axios from "axios";

const BACKEND_API_BASE_URL = import.meta.env.VITE_BACKEND_API_BASE_URL;

const props = defineProps({
  slug: String,
});

let content = ref("");
let title = ref("");

const enabledEditorPlugins = ref([
  "lists",
  "advlist",
  "anchor",
  "autolink",
  "code",
  "visualblocks",
  "template",
  "codesample",
  "emoticons",
  "fullscreen",
  "image",
  "insertdatetime",
  "link",
  "media",
  "preview",
  "searchreplace",
  "table",
  "wordcount",
  "quickbars",
]);

const submitEntry = () => {
  axios
    .post(`${BACKEND_API_BASE_URL}/entries`, {
      content: content.value,
      title: title.value,
    })
    .then((response) => {
      if (response.data.code == "ENTRY_SAVED") {
        alert("Successfully save entry");
      } else {
        alert("Error saving entry");
      }
    });
};
</script>

<template>
  <div>
    <input v-model="title" />

    <tiny-mce
      v-model="content"
      :init="{
        plugins: enabledEditorPlugins.join(' '),
        height: 500,
      }"
    >
    </tiny-mce>

    <button @click="submitEntry">Submit</button>
  </div>
</template>
