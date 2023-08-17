<script setup lang="ts">
defineProps({
    authors: {
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
    <div class="authors">
        <div v-for="author in authors" class="author" >
            <RouterLink :to="{ name: 'authorBook', params: { id: author.id }, query: { authorName: author.name } }" class="link">
                <div class="details">
                    <div class="book-title text-elipsis">{{ author.number }} {{ author.name }}</div>
                    <div class="text-elipsis">{{ author.book_count }} books</div>
                </div>
            </RouterLink>
            <div class="btn-container">
                <button class="btn-edit" @click="$router.push({ name: routeName, params: { id: author.id } })">Edit</button>
                <button class="btn-delete" @click="$emit('openModal', author.id)">Delete</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.author {
    background-color: #F6F6F6;
    /* box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15); */
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 3px;
    font-size: 12px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    gap: 1rem;
}
.details {
    overflow: hidden;
    text-align: start;
}
.book-title {
    font-family: 'Roboto-500';
    color: #333333;
    margin-bottom: 3px;
}
.btn-container{
    display: flex;
    flex-wrap: nowrap;
}
.link {
    text-decoration: none;
    flex: 1;
    overflow: hidden;
}
</style>