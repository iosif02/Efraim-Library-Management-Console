<script setup lang="ts">
import DelayedBooks from '@/components/books/DelayedBooks.vue';
import Pagination from '@/components/global/Pagination.vue';
import { booksStore } from '@/stores/booksStore';
import { watch } from 'vue';

const store = booksStore();
if(!store.delayedBooks.data.length) {
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

    <GoBack :go-back-text="`Late Books (${store.delayedBooks.total})`" />

    <SearchBar
        :defaultValue="store.delayedBooks.searchModel.title"
        @keyup="(event: any) => store.delayedBooks.searchModel.title = event?.target?.value"
    />

    <DelayedBooks :books="store.delayedBooks.data" />

    <Pagination
        :current-page="store.delayedBooks.pagination.CurrentPage"
        :last-page="store.delayedBooks.pagination.LastPage"
        @change-page="changePage"
    />
</template>