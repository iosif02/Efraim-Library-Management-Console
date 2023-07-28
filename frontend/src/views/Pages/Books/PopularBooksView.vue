<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { useBooksStore } from '@/stores/books-store';

const store = useBooksStore();
if(!store.popularBooks.data.length)
    store.fetchPopularBooks();

</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Popular Books" />

    <SearchBar
        :defaultValue="store.popularBooks.searchModel.title"
        @valueChanged="(value: string) => (store.popularBooks.searchModel.title = value, store.popularBooks.searchModel.pagination.page = 1, store.fetchPopularBooks())"
        placeholder='Search book...'
    />

    <PopularBooks :books="store.popularBooks.data" />

    <Pagination
        :current-page="store.popularBooks.searchModel.pagination.page"
        :last-page="store.popularBooks.searchModel.pagination.last_page"
        @change-page="(page: number) => (store.popularBooks.searchModel.pagination.page = page, store.fetchPopularBooks())"
    />
</template>