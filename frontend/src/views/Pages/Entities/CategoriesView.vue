<script setup lang="ts">
import Pagination from '@/components/global/PaginationComponent.vue';
import CategoriesComponent from '@/components/entities/CategoriesComponent.vue';
import { useEntitiesStore } from '@/stores/entities-store';
import CreateButtonComponent from "@/components/global/CreateButtonComponent.vue"
import { ref } from 'vue';

const store = useEntitiesStore();
if (!store.categories.data.length)
  store.fetchCategories();

let categoryId = 0;

const showModal = ref<boolean>(false);

var deleteCategory = () => {
  showModal.value = false;
  store.deleteCategory(categoryId)
  .then(result => {
    if(result){
      store.fetchCategories();
    }
  });
}

var hideModal = () => {
  showModal.value = false;
}

var openModal = (selectedCategoryId: number) => {
  categoryId = selectedCategoryId;
  showModal.value = true;
}

</script>

<template>
  <Loading v-if="store.isLoading" />

  <Modal 
    v-if="showModal" 
    title="Delete Confirmation"
    description="Are you sure you want to delete this category?"
    action="Delete"
    @submit="deleteCategory" 
    @cancel="hideModal" 
  />

	<div>
    <GoBack goBackText="Categories"/>
	</div>

  <SearchBar
    :defaultValue="store.categories.searchModel.name"
    @valueChanged="(value: string) => (store.categories.searchModel.name = value, store.categories.searchModel.pagination.page = 1, store.fetchCategories())"
    placeholder='Search category...'
  />

  <CategoriesComponent :categories="store.categories.data" routeName="editCategory" @openModal="(selectedCategoryId) => openModal(selectedCategoryId)" />

  <Pagination
    :current-page="store.categories.searchModel.pagination.page"
    :last-page="store.categories.searchModel.pagination.last_page"
    @change-page="(page: number) => (store.categories.searchModel.pagination.page = page, store.fetchCategories())"
  />

  <CreateButtonComponent routeName="createCategory"/>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>