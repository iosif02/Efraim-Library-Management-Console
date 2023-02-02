<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooks.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';
import { watch } from 'vue';

const store = booksStore();
if(!store.popularBooks?.data.length) {
  await store.fetchPopularBooks();
}

var changePage = (page: number) => {
    store.popularBooksChangePage(page);
}

watch(() => store.delayedBooks.searchModel, async () => {
    await store.fetchPopularBooks();
}, { deep: true });
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Popular Books" />

    <SearchBar
        :defaultValue="store.popularBooks.searchModel.title"
        @keyup="(event: any) => store.popularBooks.searchModel.title = event?.target?.value"
    />

    <PopularBooks :books="store.popularBooks.data" />

    <Pagination
        :current-page="store.popularBooks.pagination.CurrentPage"
        :last-page="store.popularBooks.pagination.LastPage"
        @change-page="changePage"
    />
</template>