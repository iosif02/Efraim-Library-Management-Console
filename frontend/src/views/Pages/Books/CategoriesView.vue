<script setup lang="ts">
import Categories from '@/components/books/CategoriesComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { booksStore } from '@/stores/books-store';
import { watch } from 'vue';

const store = booksStore();
if(!store.categories?.data?.length) {
  await store.fetchCategories();
}

var changePage = (page: number) => {
    store.categoriesChangePage(page);
}

watch(() => store.delayedBooks.searchModel, async () => {
    await store.fetchCategories();
}, { deep: true });
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Categories" />

    <SearchBar
        :defaultValue="store.categories.searchModel.title"
        @keyup="(event: any) => store.categories.searchModel.title = event?.target?.value"
    />

    <Categories :categories="store.categories.data" />

    <Pagination
        :current-page="store.categories.searchModel.pagination.page"
        :last-page="store.categories.searchModel.pagination.last_page"
        @change-page="changePage"
    />
</template>