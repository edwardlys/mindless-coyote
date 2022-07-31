<script setup>
import { ref, computed } from "vue";
import * as Diff2Html from "diff2html";
import "diff2html/bundles/css/diff2html.min.css";
import TinyMce from "@tinymce/tinymce-vue";

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

let diffs = ref('');

const prettyHtml = computed(() => {
  return Diff2Html.html(diffs.value, {
    drawFileList: true,
    matching: "lines",
    outputFormat: "side-by-side",
  });
});
</script>

<template>
  <div>
    This is the diff view page

    <tiny-mce
      :init="{
        plugins: enabledEditorPlugins.join(' '),
        height: 500,
      }"
    ></tiny-mce>

    <div v-html="prettyHtml" />
  </div>
</template>
