<script setup>
import { ref, onMounted } from "vue";

let latitude = ref(0)
let longitude = ref(0);

let getLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(updateCoords);
  } 
}

let updateCoords = (position) => {
  console.log('=updated coords')
  latitude.value = position.coords.latitude;
  longitude.value = position.coords.longitude;
}

onMounted(() => {
  getLocation();
});
</script>

<template>
This is a GPS page

My current GPS location is: {{ latitude }}, {{ longitude }}

<button @click="getLocation">Get latest location</button>

</template>
