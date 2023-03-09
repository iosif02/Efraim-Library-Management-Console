<script setup lang="ts">
import Categories from '@/components/books/CategoriesComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { useEntitiesStore } from '@/stores/entities-store';
import { watch } from 'vue';

const store = useEntitiesStore();

var changePage = (page: number) => {
    store.categoriesChangePage(page);
}

watch(store.categories.searchModel, () => {
    store.fetchCategories();
}, { deep: true, immediate: true });
</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Categories" />

    <SearchBar
        :defaultValue="store.categories.searchModel.name"
        @keyup="(event: any) => store.categories.searchModel.name = event?.target?.value"
    />

    <Categories :categories="store.categories.data" />

    <Pagination
        :current-page="store.categories.searchModel.pagination.page"
        :last-page="store.categories.searchModel.pagination.last_page"
        @change-page="changePage"
    />
</template>