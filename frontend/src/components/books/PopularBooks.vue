<script setup lang="ts">
const props = defineProps(['books'])
</script>

<template>
    <div class="books">
        <div v-for="book in books" class="book">
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
</template>

<style scoped>
.books {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
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