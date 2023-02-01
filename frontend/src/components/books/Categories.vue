<script setup lang="ts">
const props = defineProps(['categories'])
</script>

<template>
    <div class="categories">
        <div v-for="(category, index) in categories" class="category" :key="index">
            <div class="book-title">{{ index + 1 }} {{ category.Name }}</div>
            <div class="book-number">{{ category.Books }} books</div>
        </div>
    </div>
</template>

<style scoped>
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