<template>
	<div>
		<h1>test</h1>
	</div>
</template>

<script setup lang="ts">
import { booksStore } from '@/stores/booksStore';

const store = booksStore();
let books = await store.fetchBooks();
</script>