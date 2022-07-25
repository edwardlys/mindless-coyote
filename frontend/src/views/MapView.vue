<script setup>
import { ref, onMounted } from "vue";
import NearbySearchResultSample from "../assets/NearbySearchResultSample.json";

const mapContainer = ref();
let map = null;
let coordinates = new window.google.maps.LatLng(3.1411083304695167, 101.69515540516795);
let places = [];
let getNextPage;

onMounted(() => {
  map = new google.maps.Map(mapContainer.value, {
    center: coordinates,
    zoom: 15,
  });

  // var request = {
  //   location: coordinates,
  //   radius: '5000',
  //   type: ['train_station']
  // };

  // let service = new window.google.maps.places.PlacesService(map);
  // service.nearbySearch(request, (results, status, pagination) => {
  //   if (status == window.google.maps.places.PlacesServiceStatus.OK) {
  //     console.log(results)
  //     console.log(JSON.stringify(results));

  //     if (pagination && pagination.hasNextPage) {
  //       console.log('have next page!')
  //       getNextPage = () => {
  //         // Note: nextPage will call the same handler function as the initial call
  //         pagination.nextPage();
  //       };

  //       getNextPage();
  //     }
  //   }
  // });
})

const BUSINESS_STATUS_OPERATIONAL = window.google.maps.places.BusinessStatus.OPERATIONAL;

console.log(NearbySearchResultSample);

</script>

<template>
  <div>
    <div ref="mapContainer" style="width: 500px; height: 500px"></div>
    <div v-for="(place, index) in NearbySearchResultSample" :key="index">
      <div v-if="place.business_status === BUSINESS_STATUS_OPERATIONAL">
        name: {{ place.name }}
      </div>
    </div>
  </div>
</template>
