<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import router from '@/router';
import { useBooksStore } from '@/stores/books-store';

const props = defineProps({
  id: String,
})

if(!props.id || props.id == '')
    router.replace({ name: 'author' });

const store = useBooksStore();

store.authorBooks.searchModel.author = props.id || '';

if(!store.authorBooks.data.length || store.authorBooks.data[0].authors[0].name != props.id)
    store.searchAuthorBooks();

</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack :go-back-text="props.id"/>

    <SearchBar
        :defaultValue="store.authorBooks.searchModel.title"
        @valueChanged="(value: string) => (store.authorBooks.searchModel.title = value, store.authorBooks.searchModel.pagination.page = 1, store.searchAuthorBooks())"
        placeholder='Search book...'
    />

    <PopularBooks :books="store.authorBooks.data" />

    <Pagination
        :current-page="store.authorBooks.searchModel.pagination.page"
        :last-page="store.authorBooks.searchModel.pagination.last_page"
        @change-page="(page: number) => (store.authorBooks.searchModel.pagination.page = page, store.searchAuthorBooks())"
    />
</template>