<script setup lang="ts">
import PopularBooks from '@/views/Components/Books/PopularBooksComponent.vue';
import Pagination from '@/views/Components/Global/PaginationComponent.vue';
import router from '@/router';
import { useBooksStore } from '@/stores/books-store';

const props = defineProps({
  id: String,
  authorName: String,
})

if(!props.id || props.id == '0' || !parseInt(props.id))
    router.replace({ name: 'author' });

const store = useBooksStore();

store.authorBooks.searchModel.author = parseInt(props.id || '')

// if(!store.authorBooks.data.length || store.authorBooks.data[0].authors[0].pivot.author_id != parseInt(props.id || ''))
store.searchAuthorBooks();

</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack :go-back-text="`${$route.query.authorName} (${store.authorBooks.searchModel.pagination.total})`"/>

    <SearchBar
        :defaultValue="store.authorBooks.searchModel.title"
        @valueChanged="(value: string) => (store.authorBooks.searchModel.title = value, store.authorBooks.searchModel.pagination.page = 1, store.searchAuthorBooks())"
        placeholder='Search book...'
    />

    <PopularBooks v-if="store.authorBooks.searchModel.pagination.total" :books="store.authorBooks.data" />
    <div class="no-found" v-else-if="!store.isLoading"> No Result Found! </div>

    <Pagination
        :current-page="store.authorBooks.searchModel.pagination.page"
        :last-page="store.authorBooks.searchModel.pagination.last_page"
        @change-page="(page: number) => (store.authorBooks.searchModel.pagination.page = page, store.searchAuthorBooks())"
    />
</template>