<script setup lang="ts">
import Categories from '@/components/books/Categories.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';

const store = booksStore();
if(!store.categories?.data?.length) {
  await store.fetchCategories();
}

var changePage = (page: number) => {
    store.categoriesChangePage(page);
}
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Categories" />

    <SearchBar
        :defaultValue="store.categories.searchModel.BookTitle"
        @keyup="(event: any) => store.categories.searchModel.BookTitle = event?.target?.value"
    />

    <Categories :categories="store.categories.data" />

    <Pagination
        :current-page="store.categories.pagination.CurrentPage"
        :last-page="store.categories.pagination.LastPage"
        @change-page="changePage"
    />
</template>