<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooks.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';

const store = booksStore();
if(!store.popularBooks?.length) {
  await store.fetchPopularBooks();
}

var changePage = (page: number) => {
    store.popularBooksChangePage(page);
}
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Popular Books" />

    <SearchBar />

    <PopularBooks :books="store.popularBooks" />

    <Pagination
        :current-page="store.popularBooksPagination.CurrentPage"
        :last-page="store.popularBooksPagination.LastPage"
        @change-page="changePage"
    />
</template>