<script setup lang="ts">
defineProps({
    publishers: {
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
        <div v-for="publisher in publishers" class="category" >
            <RouterLink :to="{ name: 'publisherBooks', params: { id: publisher.id }, query: { publisherName: publisher.name } }" class="link" >
                <div class="details">
                    <div class="book-title text-elipsis">{{ publisher.number }} {{ publisher.name }}</div>
                    <div class="text-elipsis">{{ publisher.book_count }} books</div>
                </div>
            </RouterLink>
            <div class="btn-container">
                <button class="btn-edit" @click="$router.push({ name: routeName, params: { id: publisher.id } })">Edit</button>
                <button class="btn-delete" @click="$emit('openModal', publisher.id)">Delete</button>
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