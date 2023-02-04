<script setup lang="ts">
import Books from '@/components/books/BooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { booksStore } from '@/stores/books-store';

const store = booksStore();

var changePage = (page: number) => {
    store.booksHomeChangePage(page);
}
</script>

<template>
    <div class="results">
        Results 
        <span>({{ store.homepage.searchModel.pagination.total }})</span>
    </div>
    
    <Books :books="store.homepage.data.books" />

    <Pagination
        :current-page="store.homepage.searchModel.pagination.page"
        :last-page="store.homepage.searchModel.pagination.last_page"
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