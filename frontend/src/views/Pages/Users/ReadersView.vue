<script setup lang="ts">
import router from '@/router';
import Pagination from '@/components/global/PaginationComponent.vue';
import { useUsersStore } from '@/stores/user-store';
import { ref } from 'vue';
import ReadersComponent from '@/components/users/ReadersComponent.vue';
import CreateButtonComponent from "@/components/global/CreateButtonComponent.vue"

const store = useUsersStore();

if(!store.users.data.length)
  store.fetchUsers();

const showModal = ref<boolean>(false);
let userId = 0;

var openModal = (selectedUserId: number) => {
  userId = selectedUserId;
  showModal.value = true;
}

var deleteUser = () => {
  showModal.value = false;
  store.deleteUser(userId)
  .then(result =>{
    if(result)
    store.fetchUsers();
  });
}

var hideModal = () => {
  showModal.value = false;
}
</script>

<template>
  <Loading v-if="store.isLoading" />

  <Modal 
    v-if="showModal" 
    title="Delete Confirmation"
    description="Are you sure you want to delete this user?"
    action="Delete"
    @submit="deleteUser" 
    @cancel="hideModal" 
  />

  <GoBack goBackText="Readers"/>

  <SearchBar
    :defaultValue="store.users.searchModel.name"
    @valueChanged="(value: string) => (store.users.searchModel.name = value, store.users.searchModel.pagination.page = 0, store.fetchUsers())"
    placeholder="Search user..."
  />

  <ReadersComponent :users="store.users.data" routeName="editReader" @openModal="(selectedUserId) => openModal(selectedUserId)"/>

  <Pagination
    :current-page="store.users.searchModel.pagination.page"
    :last-page="store.users.searchModel.pagination.last_page"
    @change-page="(page: number) => (store.users.searchModel.pagination.page = page, store.fetchUsers())"
  />

  <CreateButtonComponent routeName="createReader"/>
</template>
<style scoped>

</style>