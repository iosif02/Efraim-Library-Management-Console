<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import CreateButtonComponent from "@/components/global/CreateButtonComponent.vue"
import { useBooksStore } from '@/stores/books-store';

const store = useBooksStore();
store.searchBooks();

</script>

<template>
	<Loading v-if="store.isLoading" />

  <SearchBar
    :defaultValue="store.books.searchModel.title"
    @valueChanged="(value: any) => (store.books.searchModel.title = value, store.books.searchModel.pagination.page = 1, store.searchBooks())"
    placeholder='Search book...'
  />

  <PopularBooks :books="store.books.data" />

  <Pagination
    :current-page="store.books.searchModel.pagination.page"
    :last-page="store.books.searchModel.pagination.last_page"
    @change-page="(page: number) => (store.books.searchModel.pagination.page = page, store.searchBooks())"
  />

  <CreateButtonComponent route-name="createBook" />

</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>