<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <notifications />
  <Suspense>
    <RouterView />
  </Suspense>
</template>

<style>
* {
  font-family: 'Roboto-400';
  font-style: normal;
  line-height: 1.2;
  box-sizing: border-box;
  color: #AAAAAA;
}
html,body {
  margin: 0;
  padding: 0;
  height: 100%; /* needed for container min-height */
}
@font-face {
  font-family: "Roboto-400";
  src: local("Roboto-400"),
  url(./fonts/Roboto/Roboto-Regular.ttf) format("truetype");
}
@font-face {
  font-family: "Roboto-500";
  src: local("Roboto-500"),
  url(./fonts/Roboto/Roboto-Medium.ttf) format("truetype");
  color: #2B2E3C;
}
</style>
