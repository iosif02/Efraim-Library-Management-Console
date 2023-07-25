<script setup lang="ts">
import type CategoryModel from '@/models/entities/CategoryModel';
import type { PropType } from 'vue'

defineProps({
    categories: {
        type: Object as PropType<CategoryModel[]>,
        required: true
    }
});
</script>

<template>
    <div class="categories">
        <template v-for="category in categories">
            <RouterLink :to="{ name: 'categoryBook', params: { id: category.id }, query: { categoryName: category.name } }" style="text-decoration: none;">
                <div  class="category" >
                    <div class="book-title">{{ category.number }} {{ category.name }}</div>
                    <div class="book-number">{{ category.book_count }} books</div>
                </div>
            </RouterLink>
        </template>
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