<script setup lang="ts">
import AuthorIcon from '@/components/icons/AuthorIcon.vue';

</script>

<template>
  <div class="Entities">

    <GoBack goBackText="Back" :route="true">
      <p class="title">Entities</p>
    </GoBack>

    <div class="container">
      <AuthorIcon />
      <p class="container-title">Author</p>
    </div>
    <div class="container">
      <AuthorIcon />
      <p class="container-title">Category</p>
    </div>
    <div class="container">
      <AuthorIcon />
      <p class="container-title">Publisher</p>
    </div>

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