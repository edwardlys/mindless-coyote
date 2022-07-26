<script setup>
import { ref, computed } from "vue";
import * as Diff2Html from 'diff2html';
import 'diff2html/bundles/css/diff2html.min.css';

let diffs = ref(`diff --git a/frontend/package-lock.json b/frontend/package-lock.json
index 1c26875..3dfae97 100644
--- a/frontend/package-lock.json
+++ b/frontend/package-lock.json
@@ -8,6 +8,7 @@
       "name": "mindless-coyote-frontend",
       "version": "0.0.0",
       "dependencies": {
+        "diff2html-cli": "^5.2.5",
         "pinia": "^2.0.16",
         "vue": "^3.2.37",
         "vue-router": "^4.1.2"
@@ -213,6 +214,11 @@
       "resolved": "https://registry.npmjs.org/@vue/shared/-/shared-3.2.37.tgz",
       "integrity": "sha512-4rSJemR2NQIo9Klm1vabqWjD8rs/ZaJSzMxkMNeJS6lHiUjjUeYFbooN19NgFjztubEKh3WlZUeOLVdbbUWHsw=="
     },
+    "node_modules/abbrev": {
+      "version": "1.1.1",
+      "resolved": "https://registry.npmjs.org/abbrev/-/abbrev-1.1.1.tgz",
+      "integrity": "sha512-nne9/IiQ/hzIhY6pdDnbBtz7DjPTKrY00P/zvPSm5pOFkl6xuGrGnXn/VtTNNfNtAfZ9/1RtehkszU9qcTii0Q=="
+    },
     "node_modules/acorn": {
       "version": "8.8.0",
       "resolved": "https://registry.npmjs.org/acorn/-/acorn-8.8.0.tgz",
@@ -254,7 +260,6 @@
       "version": "5.0.1",
       "resolved": "https://registry.npmjs.org/ansi-regex/-/ansi-regex-5.0.1.tgz",
       "integrity": "sha512-quJQXlTSUGL2LH9SUXo8VwsY4soanhgo6LNSm84E1LBcE8s3O0wpdiRzyR9z/ZZJMlMWv37qOOb9pdJlMUEKFQ==",        
-      "dev": true,
       "engines": {
         "node": ">=8"
       }
@@ -263,7 +268,6 @@
       "version": "4.3.0",
       "resolved": "https://registry.npmjs.org/ansi-styles/-/ansi-styles-4.3.0.tgz",
       "integrity": "sha512-zbB9rCJAT1rbjiVDb2hqKFHNYLxgtk8NURxZ3IZwD3F6NtxbXZQCnnSi1Lkx+IDohdPlFp222wVALIheZJQSEg==",        
-      "dev": true,
       "dependencies": {
         "color-convert": "^2.0.1"
       },`);

const prettyHtml = computed(() => {
  return Diff2Html.html(diffs.value, {
    drawFileList: true,
    matching: 'lines',
    outputFormat: 'side-by-side',
  });
})

const generateDiff = () => {
  console.log(Diff2html.html(diffJson, { drawFileList: true }));
};


</script>

<template>
  <div>
    This is the diff view page

    <div v-html="prettyHtml" />

    <button @click="generateDiff">Do somethign</button>
  </div>
</template>