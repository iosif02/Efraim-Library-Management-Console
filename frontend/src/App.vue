<script setup lang="ts">
import { RouterView } from "vue-router";
</script>

<template>
  <notifications style="z-index: 10;" position="bottom center" closeOnClick="true" />
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
.text-color{
  color: black !important;
}
.vue-notification{
  width: 300px; 
  position: absolute;
  bottom: 90px;
  border-radius: 100px;
}
.notification-content {
  text-align: center;
  color: #fff;
}
.success {
  background: rgba(104, 205, 134, 1) !important;
  border-left-color: rgba(66, 168, 95, 1) !important;
}
.warn {
  background: rgba(255, 182, 72, 1) !important;
  border-left-color: rgba(244, 138, 6, 1) !important;
}
.error {
  background: rgba(229, 77, 66, 1) !important;
  border-left-color: rgba(184, 46, 36, 1) !important;
}
</style>
