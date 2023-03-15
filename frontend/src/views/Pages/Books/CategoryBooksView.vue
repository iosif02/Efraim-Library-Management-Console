<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import router from '@/router';
import { useBooksStore } from '@/stores/books-store';
import { watch } from 'vue';

const props = defineProps({
  id: String
})

if(!props.id || props.id == '0' || !parseInt(props.id)){
  router.back();
}

const store = useBooksStore();

store.categoryBooks.searchModel.category = parseInt(props.id || '')

var changePage = (page: number) => {
    store.categoryBooks.searchModel.pagination.page = page;
}


watch(() => store.categoryBooks.searchModel, () => {
    store.searchCategoryBooks();
}, { deep: true, immediate: true});
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Category Book" />

    <SearchBar
        :defaultValue="store.categoryBooks.searchModel.title"
        @valueChanged="(value: string) => store.categoryBooks.searchModel.title = value"
        placeholder='Search book...'
    />

    <PopularBooks :books="store.categoryBooks.data" />

    <Pagination
        :current-page="store.categoryBooks.searchModel.pagination.page"
        :last-page="store.categoryBooks.searchModel.pagination.last_page"
        @change-page="changePage"
    />
</template>