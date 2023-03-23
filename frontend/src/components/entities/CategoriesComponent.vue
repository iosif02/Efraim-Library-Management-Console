<script setup lang="ts">
defineProps({
    categories: {
        type: Object as any,
        required: true
    },
    routeName: {
        type: String,
        required: false
    }
});
</script>

<template>
    <div class="categories">
        <div v-for="category in categories" class="category" >
            <div>
                <div class="book-title">{{ category.number }} {{ category.name }}</div>
                <div class="book-number">{{ category.book_count }} books</div>
            </div>
            <div>
                <button class="btn-edit" @click="$router.push({ name: routeName, params: { id: category.id } })">Edit</button>
                <button class="btn-delete" @click="$emit('openModal', category.id)">Delete</button>
            </div>
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
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.book-title {
    font-family: 'Roboto-500';
    color: #333333;
    margin-bottom: 3px;
}
</style>