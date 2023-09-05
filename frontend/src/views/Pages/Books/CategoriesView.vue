<script setup lang="ts">
import Categories from '@/components/books/CategoriesComponent.vue';
import Pagination from '@/components/global/PaginationComponent.vue';
import { useEntitiesStore } from '@/stores/entities-store';

const store = useEntitiesStore();
// if(!store.categories.data.length)
    store.fetchCategories();

</script>

<template>
    <Loading v-if="store.isLoading" />

    <GoBack go-back-text="Categories" />

    <SearchBar
        :defaultValue="store.categories.searchModel.name"
        @valueChanged="(value: string) => (store.categories.searchModel.name = value, store.categories.searchModel.pagination.page = 1, store.fetchCategories())"
        placeholder='Search category...'
    />

    <Categories v-if="store.categories.searchModel.pagination.total" :categories="store.categories.data" />
    <div class="no-found" v-else-if="!store.isLoading"> No Result Found! </div>

    <Pagination
        :current-page="store.categories.searchModel.pagination.page"
        :last-page="store.categories.searchModel.pagination.last_page"
        @change-page="(page: number) => (store.categories.searchModel.pagination.page = page, store.fetchCategories())"
    />
</template>