<script setup lang="ts">
import type BookModel from '@/models/book/BookModel';
import type { PropType } from 'vue'
import { RouterLink } from "vue-router";

defineProps({
    books: {
        type: Object as PropType<BookModel[]>,
        required: true
    }
});
</script>

<template>
    <div class="books">
        <template v-for="book in books">
            <RouterLink :to="{ name: 'bookDetails', params: { id: book.id} }" style="text-decoration: none;" class="book">
                <!-- <div class="book"> -->
                    <img :src="book.image" alt="">
                    <div class="details">
                        <div class="title">{{ book.title }}</div>
                        <div class="author">{{ book.authors?.[0]?.name }}</div>
                        <div class="category">
                            <span class="category-number">({{ book.category?.number }})</span>
                            <span class="category-name">{{ book.category?.name }}</span>
                        </div>
                    </div>
                <!-- </div> -->
            </RouterLink>
        </template>
    </div>
</template>

<style scoped>
.books {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
.book {
    width: 98px;
}
.books .book:nth-child(3n + 2),
.books .book:last-child:nth-child(3n + 2) {
    justify-self: center;
}

.books .book:nth-child(3n),
.books .book:last-child:nth-child(3n) {
    justify-self: right;
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