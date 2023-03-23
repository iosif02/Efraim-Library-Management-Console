<script setup lang="ts">
import AuthorIcon from '@/components/icons/AuthorIcon.vue';
import { RouterLink } from "vue-router";

</script>

<template>
  <div class="Entities">

    <RouterLink :to="{ name: 'author' }" class="container">
      <AuthorIcon />
      <p class="container-title">Authors</p>
    </RouterLink>

    <RouterLink :to="{ name: 'category' }" class="container">
      <AuthorIcon />
      <p class="container-title">Categories</p>
    </RouterLink>

    <RouterLink :to="{ name: 'publisher' }" class="container">
      <AuthorIcon />
      <p class="container-title">Publishers</p>
    </RouterLink>

  </div>
</template>

<style scoped>
.title{
  font-family: 'Arial';
  font-style: normal;
  font-weight: 600;
  font-size: 18px;
  line-height: 20px;
  color: #000000;
}
.container{
  text-decoration: none;
  display: flex;
  flex-direction: row;
  align-items: center;
  padding-left: 12px;
  width: 100%;
  height: 48px;
  border-radius: 12px;
  background: #FFFFFF;
  box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.06), 4px 2px 48px rgba(0, 0, 0, 0.12);
  border-radius: 12px;
  margin-bottom: 20px;
}
.container-title{
  padding-left: 15px;
  font-family: 'Roboto-500';
  font-style: normal;
  font-size: 14px;
  line-height: 20px;
  color: #6D727A;
}
</style>