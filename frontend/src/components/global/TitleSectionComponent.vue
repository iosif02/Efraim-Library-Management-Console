<script setup lang="ts">
import ChevronRightIcon from "@/components/icons/ChevronRightIcon.vue";
import { RouterLink } from "vue-router";

const props = defineProps(['title', 'routeName'])
</script>

<template>
  <div class="category-title">
    <div class="title">{{ title }}</div>
    <RouterLink :to="{ name: routeName }">
      <ChevronRightIcon />
    </RouterLink>
  </div>
</template>

<style scoped>
.category-title {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}
.title {
  font-family: 'Roboto-500';
  color: #2B2E3C;
}
</style>