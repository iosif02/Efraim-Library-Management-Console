<script setup lang="ts">
import SearchIcon from "@/components/icons/SearchIcon.vue";

const props = defineProps({
  defaultValue: {
    type: String
  },
  route: {
    type: String
  },
  placeholder: {
    type: String
  }
})
let searchValue = props?.defaultValue;

const emit = defineEmits(['valueChanged'])

var timer = 0;
var textSearch = () => {
  clearTimeout(timer)

  timer = setTimeout(() => {
    emit.call(this, 'valueChanged', searchValue);
  }, 400)
}
</script>

<template>
  <div class="search-container">
    <SearchIcon />
    <input v-model="searchValue" class="search" type="text" :placeholder="placeholder" @keyup="textSearch">
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
  font-family: 'Roboto-400';
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