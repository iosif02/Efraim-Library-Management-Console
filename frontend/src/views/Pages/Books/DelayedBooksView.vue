<script setup lang="ts">
import DelayedBooks from '@/components/books/DelayedBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { useBooksStore } from '@/stores/books-store';
import { watch } from 'vue';

const store = useBooksStore();

var changePage = (page: number) => {
    store.delayedBooks.searchModel.pagination.page = page;
}

watch(store.delayedBooks.searchModel, () => {
    store.fetchDelayedBooks();
}, { deep: true, immediate: true });
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack :go-back-text="`Late Books (${store.delayedBooks.searchModel.pagination.total})`" />

    <SearchBar
        :defaultValue="store.delayedBooks.searchModel.title"
        @valueChanged="(value: string) => store.delayedBooks.searchModel.title = value"
        placeholder='Search book...'
    />

    <DelayedBooks :books="store.delayedBooks.data" />

    <Pagination
        :current-page="store.delayedBooks.searchModel.pagination.page"
        :last-page="store.delayedBooks.searchModel.pagination.last_page"
        @change-page="changePage"
    />
</template>