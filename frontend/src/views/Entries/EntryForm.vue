<script setup>
import { ref, onMounted, computed, inject } from "vue";
import { useToast } from "vue-toastification";
import TinyMce from "@tinymce/tinymce-vue";
import axios from "axios";

const BACKEND_API_BASE_URL = import.meta.env.VITE_BACKEND_BASE_URL;
const UPDATE_MODE = 'UPDATE_MODE';
const CREATE_MODE = 'CREATE_MODE';
const $backend = inject('$backend');

const toast = useToast();

const props = defineProps({
  slug: String,
});

const mode = computed(() => {
  return props.slug ? UPDATE_MODE : CREATE_MODE;
})

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

const submit = () => {
  $backend.get("/sanctum/csrf-cookie").then(() => {
    if (mode.value == UPDATE_MODE) {
      $backend
        .put(`${BACKEND_API_BASE_URL}/api/entries/${props.slug}`, {
          content: content.value,
          title: title.value,
        })
        .then((response) => {
          if (response.data.code == "ENTRY_UPDATED") {
            toast.success("Successfully updated entry.")
          } else {
            toast.error("Unable to save the entry, please try again later.");
          }
        });
    }

    if (mode.value == CREATE_MODE) {
      $backend
        .post(`${BACKEND_API_BASE_URL}/api/entries`, {
          content: content.value,
          title: title.value,
        })
        .then((response) => {
          if (response.data.code == "ENTRY_SAVED") {
            toast.success("Successfully save entry.")
          } else {
            toast.error("Unable to save the entry, please try again later.");
          }
        });
    }
  });
};

onMounted(() => {
  if (mode.value == UPDATE_MODE) {
    axios
      .get(`${BACKEND_API_BASE_URL}/api/entries/${props.slug}`)
      .then((response) => {
        if (response.data.code == "ENTRY_RETRIEVED") {
          content.value = response.data.data.entry.content;
          title.value = response.data.data.entry.title;
        } else {
          toast.error("Unable to get the entry data. Please try again later.");
        }
      });
  }
})
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

    <button @click="submit">Submit</button>
  </div>
</template>
