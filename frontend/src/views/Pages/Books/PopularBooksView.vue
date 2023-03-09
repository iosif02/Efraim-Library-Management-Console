<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { useBooksStore } from '@/stores/books-store';
import { watch } from 'vue';

const store = useBooksStore();

var changePage = (page: number) => {
    store.popularBooksChangePage(page);
}

watch(store.popularBooks.searchModel, () => {
    store.fetchPopularBooks();
}, { deep: true, immediate: true});
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