<script setup lang="ts">
import Categories from '@/components/books/Categories.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';

const store = booksStore();
if(!store.categories?.length) {
  await store.fetchCategories();
}

var changePage = (page: number) => {
    // Change pagination and fetch data
}
</script>

<template>
    <Categories :categories="store.categories" />

    <Pagination
        :current-page="store.categoriesPagination.CurrentPage"
        :last-page="store.categoriesPagination.LastPage"
        @change-page="changePage"
    />
</template>