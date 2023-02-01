<script setup lang="ts">
import DelayedBooks from '@/components/books/DelayedBooks.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';
import { watch } from 'vue';

const store = booksStore();
if(!store.delayedBooks.data.Books.length) {
  await store.fetchDelayedBooks();
}

var changePage = (page: number) => {
    store.delayedBooksChangePage(page);
}

watch(() => store.delayedBooks.searchModel, async () => {
    await store.fetchDelayedBooks();
}, { deep: true });
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack :go-back-text="`Late Books (${store.delayedBooks.data.Total})`" />

    <SearchBar
        :defaultValue="store.delayedBooks.searchModel.BookTitle"
        @keyup="(event: any) => store.delayedBooks.searchModel.BookTitle = event?.target?.value"
    />

    <DelayedBooks :books="store.delayedBooks.data.Books" />

    <Pagination
        :current-page="store.delayedBooks.pagination.CurrentPage"
        :last-page="store.delayedBooks.pagination.LastPage"
        @change-page="changePage"
    />
</template>