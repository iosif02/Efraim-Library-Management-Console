<script setup lang="ts">
const props = defineProps(['currentPage', 'lastPage'])

// Create array
let links = Array.from(Array(props.lastPage).keys()).map(x => ({ page: x + 1, active: props.currentPage == x + 1, dots: false }));
// Set the dots
links = links.map(x => ({ ...x, dots: !(x.page == 1 || x.page == props.lastPage || x.page == props.currentPage || x.page == props.currentPage + 1 || x.page == props.currentPage - 1) }))
// Remove useless links
links = links.filter(x => x.dots == false || (x.dots == true && (x.page + 2 == props.currentPage || x.page - 2 == props.currentPage)));
</script>

<template>
    <div class="pagination">
        <div v-for="link in links">
            <div v-if="link.active" class="link active">
                {{ link.page }}
            </div>
            <div v-else-if="!link.dots" class="link" @click="$emit('changePage', link.page)">
                {{ link.page }}
            </div>
            <div v-else-if="link.dots">...</div>
        </div>
    </div>
</template>

<style scoped>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px 0 10px 0;
}
.link {
    padding: 0 16px;
}
.active {
    background: rgba(118, 206, 203, 0.25);
    color: #76CECB;
    padding: 10px 16px;
    border-radius: 20px;
}
</style>