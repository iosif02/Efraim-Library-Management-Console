<script setup lang="ts">
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import router from '@/router';
import { useBooksStore } from '@/stores/books-store';

const props = defineProps({
  id: String,
  userName: String,
})

if(!props.id || props.id == '0' || !parseInt(props.id))
    router.replace({ name: 'readers' });

const store = useBooksStore();
store.userBorrowedBooks.searchModel.user = parseInt(props.id || '')
store.searchUserBorrowedBooks();

</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack :go-back-text="$route.query.userName"/>

    <SearchBar
        :defaultValue="store.userBorrowedBooks.searchModel.title"
        @valueChanged="(value: string) => (store.userBorrowedBooks.searchModel.title = value, store.userBorrowedBooks.searchModel.pagination.page = 1, store.searchUserBorrowedBooks())"
        placeholder='Search book...'
    />

    <PopularBooks :books="store.userBorrowedBooks.data" />

    <Pagination
        :current-page="store.userBorrowedBooks.searchModel.pagination.page"
        :last-page="store.userBorrowedBooks.searchModel.pagination.last_page"
        @change-page="(page: number) => (store.userBorrowedBooks.searchModel.pagination.page = page, store.searchUserBorrowedBooks())"
    />
</template>