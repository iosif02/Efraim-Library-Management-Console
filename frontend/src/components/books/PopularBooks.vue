<script setup lang="ts">
import { booksStore } from '@/stores/booksStore';
import ChevronRightIcon from "@/components/icons/ChevronRightIcon.vue";

const store = booksStore();
</script>

<template>
    <div class="popular-books">
        <div class="category-title">
            <div class="title">Popular Books</div>
            <div class="see-all">
                <ChevronRightIcon />
            </div>
        </div>
        <div class="books">
            <div v-for="book in store.getPopularBooks" class="book">
                <img :src="book.PhotoUrl" alt="">
                <div class="details">
                    <div class="title">{{ book.BookTitle }}</div>
                    <div class="author">{{ book.AuthorName }}</div>
                    <div class="category">
                        <span class="category-number">({{ book.CategoryNumber }})</span>
                        <span class="category-name">{{ book.CategoryName }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.category-title {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}
.title {
    font-family: 'Roboto-500';
    color: #2B2E3C;
}
.popular-books {
    margin-bottom: 20px;
}
.books {
    /* display: grid;
    grid-template-columns: repeat(3, 1fr); */
    display: flex;
    justify-content: space-between;
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
.author {
    padding: 5px 0;
}
</style>