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
  font-family: 'Roboto';
  font-style: normal;
  line-height: 1.2;
  box-sizing: border-box;
}
html,body {
  margin:0;
  padding:0;
  height:100%; /* needed for container min-height */
}
</style>
