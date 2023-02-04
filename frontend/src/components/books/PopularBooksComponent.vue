<script setup lang="ts">
import type BookModel from '@/models/book/BookModel';
import type { PropType } from 'vue'

defineProps({
    books: {
        type: Object as PropType<BookModel[]>,
        required: true
    }
});
</script>

<template>
    <div class="books">
        <div v-for="book in books" class="book">
            <img :src="book.image" alt="">
            <div class="details">
                <div class="title">{{ book.title }}</div>
                <div class="author">{{ book.authors?.[0]?.name }}</div>
                <div class="category">
                    <span class="category-number">({{ book.category?.number }})</span>
                    <span class="category-name">{{ book.category?.name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.books {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}
.books .book:nth-child(n + 1) {
    justify-self: center;
}
.books .book:nth-child(n + 2) {
    justify-self: right;
}
.book {
    width: 98px;
}
img {
    width: 100%;
    height: 128px;
    border-radius: 12px;
    object-fit: cover;
}
.author {
    font-size: 12px;
    color: #4974A5;
    font-family: 'Roboto-500';
    padding: 5px 0;
}
.title {
    color: #2B2E3C;
}
.category {
    font-size: 12px;
}
.category-number {
    color: #76CECB;
    padding-right: 5px;
}
.title, .author, .category {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 98px;
}
</style>