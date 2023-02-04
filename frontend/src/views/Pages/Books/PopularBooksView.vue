<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { booksStore } from '@/stores/books-store';
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
        :current-page="store.popularBooks.searchModel.pagination.page"
        :last-page="store.popularBooks.searchModel.pagination.last_page"
        @change-page="changePage"
    />
</template>