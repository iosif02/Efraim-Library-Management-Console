<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
import NavigationBar from "@/components/NavigationBar.vue";
</script>

<template>
  <div class="layout">
    <div class="content">
      <RouterView />
    </div>
    <NavigationBar />
  </div>
</template>

<style scoped>
.layout {
  height:auto !important; /* real browsers */
  height:100%; /* IE6: treaded as min-height*/

  min-height:100%; /* real browsers */
}
.content {
  padding: 1.5rem;
  padding-bottom: 5rem;
}
</style>
    