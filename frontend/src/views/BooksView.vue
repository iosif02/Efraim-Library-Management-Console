<template>
	<div>
    	<button class="btn">OK</button>
	</div>
</template>

<script setup lang="ts">
import { booksStore } from '@/stores/booksStore';

const store = booksStore();
let books = await store.fetchBooks();
</script>