<script setup lang="ts">
import { booksStore } from '@/stores/booksStore';
import SearchBar from '@/components/global/SearchBar.vue';
import DelayedBooks from '@/components/books/DelayedBooks.vue';
import PopularBooks from '@/components/books/PopularBooks.vue';
import Categories from '@/components/books/Categories.vue';

const store = booksStore();
let books = await store.fetchBooks();

</script>

<template>
	<div class="homepage">
    <SearchBar />

    <DelayedBooks />

    <PopularBooks />

    <Categories />
	</div>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>