<script setup lang="ts">
import StatusBookComponent from '@/components/global/StatusBookComponent.vue';
import router from '@/router';
import { RouterLink } from "vue-router";
import { useBooksStore } from '@/stores/books-store';
import { ref, watchEffect } from 'vue';

const props = defineProps({
  id: String
})

if(!props.id || props.id == '0' || !parseInt(props.id)){
  router.back();
}

const store = useBooksStore();
if(store.bookDetails.id != parseInt(props.id || ''))
  store.fetchBookDetails(props.id ?? "");

var onReturn = (transactionId: number) => {
  store.returnBook(transactionId);
  store.fetchBookDetails(props.id ?? "");
}
const showModal = ref<boolean>(false);

var deleteBook = () => {
  watchEffect(() => {
    showModal.value = false;
  });
  store.deleteBook(parseInt(props.id || ''))
  .then(result => {
    if(result){
      store.searchBooks();
      router.back();
    }
  });
}

var hideModal = () => {
  watchEffect(() => {
    showModal.value = false;
  });
}

var openModal = () => {
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
    description="Are you sure you want to delete this book?"
    action="Delete"
    @submit="deleteBook" 
    @cancel="hideModal" 
  />

  <GoBack goBackText="Back">
    <button @click="openModal" class="btnEdit">delete</button>
  </GoBack>
  
  <div class="image-book">
    <div class="image">
      <img :src="store.bookDetails.image" />
    </div>
    <p class="book-title">{{ store.bookDetails.title }}</p>
    <!-- TODO: show name of all authors -->
    <p class="book-author">{{ store.bookDetails.authors?.[0]?.name }}</p>
    <div class="book-category">
      <span>({{ store.bookDetails.category?.number }})</span>
      <p>{{ store.bookDetails.category?.name }}</p>
    </div>
  </div>

  <div class="copy-books">
    <p>Total Copies <span>({{ store.bookDetails.quantity }})</span></p>
    <div class="circle">
      <div v-for="book in store.bookDetails.quantity" :class="{'unavaible': book <= store.bookDetails.transaction_count}"></div>
    </div>
  </div>

  <div class="borrow-book" v-for="transaction in store.bookDetails.transaction">
    <div>
      <div class="row">
        <p class="transaction-name">{{ transaction.user_details?.first_name + ' ' + transaction.user_details?.last_name }}</p>
        <StatusBookComponent :status="store.bookDetails.status"/>
      </div>
      <p class="transaction-date">{{ transaction.borrow_date + ' - ' + transaction.return_date }}</p>
    </div> 
    <div class="row">
      <p class="transaction-voluntary">Processed by <span>Adelina Oprea</span></p>
      <p class="transaction-return" @click="onReturn(transaction.id)">Return</p>
    </div>
  </div>

  <RouterLink :to="{ name: 'borrowBook', params: { id: props.id }}">
    <button class="btn w-100" :disabled="store.bookDetails.status == 0 ?? false" >Borrow</button>
  </RouterLink>

</template>

<style scoped>
.row{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
.image-book{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-bottom: 30px;
}
.image {
  width: 178px;
  height: 216px;
  margin-bottom: 20px;
}
.image img {
  border-radius: 12px;
  object-fit: cover;
  height: 100%;
  width: 100%;
}
.book-title{
  font-family: 'Roboto-500';
  font-size: 20px;
  color: black;
  line-height: 32px;
  text-align: center;
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
.copy-books{
  flex-direction: row;
  display: flex;
  flex-wrap: wrap;
  margin-bottom: 15px;
}
.copy-books p{
  font-family: 'Roboto-500';
  font-size: 14px;
  line-height: 24px;
  color: #2B2E3C;
  align-self: center;
}
.circle{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  margin-left: 7px;
}
.circle .unavaible{
  background-color: #F2DCDC;
}
.circle div{
  width: 24px;
  height: 24px;
  border-radius: 100%;
  background-color: #E7E7E7;
  margin-left: 12px;
}
.borrow-book{
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 104px;
  background-color: #F6F6F6;
  border-radius: 8px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
  padding: 16px 10px;
  justify-content: space-between;
  margin-bottom: 15px;
}
.status {
    font-size: 12px;
    color: #76CE9F;
    background-color: #DCF2E7;
    border-radius: 22px;
    padding: 5px 10px 5px 20px;
    position: relative;
    top: -8px;
}
.status::before {
  content: '';
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 5px;
  height: 5px;
  background: #76CE9F;
  border-radius: 50%;
  left: 10px;
}
.transaction-name{
  font-family: 'Roboto-500';
  font-size: 12px;
  line-height: 14.06px;
  color: #333333;
  /* letter-spacing: 1px; */
}
.transaction-date{
  font-family: 'Roboto-500';
  font-style: normal;
  font-weight: 500;
  font-size: 12px;
  line-height: 14px;
  /* letter-spacing: 1px; */
}
.transaction-voluntary{
  font-family: 'Roboto-400';
  font-style: normal;
  color: #8A8A8A;
  font-size: 12px;
  line-height: 14px;
/* letter-spacing: 1px; */
}
.transaction-voluntary span{
  font-family: 'Roboto-400';
  font-weight: 700;
}
.transaction-return{
  font-family: 'Roboto';
  font-style: normal;
  font-weight: 500;
  font-size: 12px;
  line-height: 14px;
  /* letter-spacing: 1px; */
  text-decoration-line: underline;
  color: #76CECB;
}
.btnEdit{
  width: 69px;
  height: 24px;
  background: #CE7679;
  border-radius: 7px;
  border: none;

  font-family: 'Roboto-400';
  font-style: normal;
  font-size: 14px;
  line-height: 15px;
  color: #FFFFFF;
}
</style>