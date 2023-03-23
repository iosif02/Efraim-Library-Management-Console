<script setup lang="ts">
import Pagination from '@/components/global/PaginationComponent.vue';
import CategoriesComponent from '@/components/entities/CategoriesComponent.vue';
import { useEntitiesStore } from '@/stores/entities-store';
import CreateButtonComponent from "@/components/global/CreateButtonComponent.vue"
import { ref, watchEffect } from 'vue';

const store = useEntitiesStore();
if (!store.authors.data.length)
  store.fetchAuthors();

let authorId = 0;

const showModal = ref<boolean>(false);

var deleteAuthor = () => {
  watchEffect(() => {
    showModal.value = false;
  });
  store.deleteAuthor(authorId)
  .then(result => {
    if(result){
      store.fetchAuthors();
    }
  });
}

var hideModal = () => {
  watchEffect(() => {
    showModal.value = false;
  });
}

var openModal = (selectedAuthorId: number) => {
  authorId = selectedAuthorId;
  watchEffect(() => {
    showModal.value = true;
  });
}

</script>

<template>
  <Loading v-if="store.isLoading" />

  <Modal 
    v-if="showModal" 
    title="Delete Confirmation"
    description="Are you sure you want to delete this author?"
    action="Delete"
    @submit="deleteAuthor" 
    @cancel="hideModal" 
  />

	<div>
    <GoBack goBackText="Authors"/>
	</div>

  <SearchBar
    :defaultValue="store.authors.searchModel.name"
    @valueChanged="(value: string) => (store.authors.searchModel.name = value, store.authors.searchModel.pagination.page = 0, store.fetchAuthors())"
    placeholder='Search author...'
  />

  <CategoriesComponent :categories="store.authors.data" routeName="editAuthor" @openModal="(selectedAuthorId) => openModal(selectedAuthorId)"/>

  <Pagination
    :current-page="store.authors.searchModel.pagination.page"
    :last-page="store.authors.searchModel.pagination.last_page"
    @change-page="(page: number) => (store.authors.searchModel.pagination.page = page, store.fetchAuthors())"
  />

  <CreateButtonComponent routeName="createAuthor"/>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>