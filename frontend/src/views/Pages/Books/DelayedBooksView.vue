<script setup lang="ts">
import DelayedBooks from '@/components/books/DelayedBooks.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';

const store = booksStore();
if(!store.delayedBooks.Books.length) {
  await store.fetchDelayedBooks();
}

var changePage = (page: number) => {
    store.delayedBooksChangePage(page);
}
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Late Books" />

    <SearchBar />

    <DelayedBooks :books="store.delayedBooks.Books" />

    <Pagination
        :current-page="store.delayedBooksPagination.CurrentPage"
        :last-page="store.delayedBooksPagination.LastPage"
        @change-page="changePage"
    />
</template>