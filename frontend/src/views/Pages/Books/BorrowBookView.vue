<script setup lang="ts">
import router from '@/router';
import Pagination from '@/components/global/PaginationComponent.vue';
import { useBooksStore } from '@/stores/books-store';
import { useUsersStore } from '@/stores/user-store';
import { watch } from 'vue';
import UsersComponent from '@/components/books/UsersComponent.vue';

const props = defineProps({
  id: String
})

if(!props.id || props.id == '0' || !parseInt(props.id)){
  router.back();
}

const BooksStore = useBooksStore();
const UsersStore = useUsersStore();

BooksStore.fetchBookDetails(props.id ?? "");

var changePage = (page: number) => {
  UsersStore.userChangePage(page);
}

watch(UsersStore.users.searchModel, () => {
  UsersStore.fetchUsers();
}, { deep: true, immediate: true });

</script>

<template>
  <Loading v-if="BooksStore.isLoading || UsersStore.isLoading" />

  <GoBack goBackText="Back"/>

  <div class="image-section">
      <div class="image">
          <img :src="BooksStore.bookDetails.image" alt="book">
      </div>
      <div class="details-section">
          <p class="book-title">{{ BooksStore.bookDetails.title }}</p>
          <p class="book-author">{{ BooksStore.bookDetails.authors?.[0]?.name }}</p>
          <div class="book-category">
              <span>({{ BooksStore.bookDetails.category?.number }})</span>
              <p>{{ BooksStore.bookDetails.category?.name }}</p>
          </div>
      </div>
  </div>

  <SearchBar
      :defaultValue="UsersStore.users.searchModel.name"
      @keyup="(event: any) => UsersStore.users.searchModel.name = event?.target?.value"
      :route="'borrowBook'"
  />

  <UsersComponent :users="UsersStore.users.data"/>

  <Pagination
        :current-page="UsersStore.users.searchModel.pagination.page"
        :last-page="UsersStore.users.searchModel.pagination.last_page"
        @change-page="changePage"
    />

</template>

<style scoped>
.image {
    width: 90px;
    height: 96px;
}
.image img {
  border-radius: 12px;
  object-fit: cover;
  height: 100%;
  width: 100%;
}
.image-section{
    display: flex;
    flex-direction: row;
    margin-bottom: 13px;
}
.book-title{
    font-family: 'Roboto-500';
    font-size: 16px;
    color: black;
    line-height: 24px;
}
.book-author{
  font-family: 'Roboto-500';
  line-height: 24px;
  font-size: 16px;
  color: #4974A5;
}
.book-category{
  display: flex;
  flex-direction: row;
  margin-top: 5px;
}
.book-category span{
  font-family: 'Roboto-400';
  color: #76CECB;
  padding-right: 3px;
  line-height: 20px;
  font-size: 14px;
}
.book-category p{
  font-family: 'Roboto-400';
  line-height: 20px;
  font-size: 14px;
}
.details-section{
    margin-left: 13px;
}
</style>