<script setup lang="ts">
import ChevronLeftIcon from "@/components/icons/ChevronLeftIcon.vue";
import router from "@/router";
</script>

<template>
    <div class="back-button">
        <span @click="router.back()">
            <ChevronLeftIcon />
            <span class="title">Back</span>
        </span>
    </div>
</template>

<style scoped>
.title {
  font-family: 'Roboto-500';
  color: #2B2E3C;
  margin-left: 10px;
}
.back-button {
    margin: 30px 0 24px 0;
}
</style>