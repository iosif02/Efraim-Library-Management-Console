<script setup lang="ts">
import SearchIcon from "@/components/icons/SearchIcon.vue";
</script>

<template>
  <div class="search-container">
    <SearchIcon />
    <input class="search" type="search" placeholder="Search books...">
  </div>
</template>

<style>
.search-container {
  display: flex;
  justify-content: center;
  align-items: center;
  column-gap: .5rem;
  padding: 15px 24px;
  border: none;
  width: 100%;
  height: 50px;

  background: #F6F6F7;
  border-radius: 50px;

  margin-bottom: 20px;
}
.search {
  flex: 1;
  border: none;
  background-color: transparent;
  font-family: 'Roboto';
}
.search:focus {
  outline: none;
}
.search::placeholder {
  /* font-family: 'Inter'; */
  font-family: 'Roboto';
  font-style: normal;
  font-weight: 300;
  font-size: 12px;
  line-height: 15px;

  color: #B0ACC2;
}
</style>