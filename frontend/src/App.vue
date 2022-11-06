<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <notifications />
  <Suspense>
    <RouterView />
  </Suspense>
</template>

<style scoped>
* {
  font-family: 'Roboto';
  font-style: normal;
  line-height: 1.2;
}
</style>
