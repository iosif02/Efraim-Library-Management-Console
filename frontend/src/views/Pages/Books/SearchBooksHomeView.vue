<script setup lang="ts">
import Books from '@/components/books/Books.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';

const store = booksStore();

var changePage = (page: number) => {
    store.booksHomeChangePage(page);
}
</script>

<template>
    <div class="results">
        Results 
        <span>({{ store.homepage.books?.length }})</span>
    </div>
    
    <Books :books="store.homepage.books" />

    <Pagination
        :current-page="store.homepage.pagination.CurrentPage"
        :last-page="store.homepage.pagination.LastPage"
        @change-page="changePage"
    />
</template>

<style scoped>
.results {
  font-family: 'Roboto-500';
  color: #2B2E3C;
  margin-bottom: 10px;
}
.results span {
    color: #AAAAAA;
}
</style>