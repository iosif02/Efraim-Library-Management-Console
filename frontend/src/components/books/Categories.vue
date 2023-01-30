<script setup lang="ts">
import { booksStore } from '@/stores/booksStore';
import ChevronRightIcon from "@/components/icons/ChevronRightIcon.vue";

const store = booksStore();
</script>

<template>
    <div class="categories-section">
        <div class="category-title">
            <div class="title">Categories</div>
            <div class="see-all">
                <ChevronRightIcon />
            </div>
        </div>
        <div class="categories">
            <div v-for="(category, index) in store.getCategories" class="category" :key="index">
                <div class="book-title">{{ index + 1 }} {{ category.Name }}</div>
                <div class="book-number">{{ category.Books }} books</div>
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
.category {
    background-color: #F6F6F6;
    /* box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15); */
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 3px;
    font-size: 12px;
}
.book-title {
    font-family: 'Roboto-500';
    color: #333333;
    margin-bottom: 3px;
}
</style>