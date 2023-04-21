<script setup lang="ts">
import type BookModel from '@/models/book/BookModel';
import type { PropType } from 'vue'
import StatusBookComponent from '@/components/global/StatusBookComponent.vue';

defineProps({
    books: {
        type: Object as PropType<BookModel>,
        required: true
    }
});

</script>

<template>
    <div class="borrow-list">
        <div class="borrow-book" v-for="transaction in books.transaction">
            <div>
                <div class="row">
                    <p class="transaction-name">{{ transaction.user?.first_name + ' ' + transaction.user?.last_name }}</p>
                    <StatusBookComponent :status="books.status"/>
                </div>
                <p class="transaction-date">{{ transaction.borrow_date + ' - ' + transaction.return_date }}</p>
            </div> 
            <div class="row">
                <p class="transaction-voluntary">Processed by <span>{{ transaction.lender_name }}</span></p>
                <p class="transaction-return" @click="$emit('onReturn', transaction.id)">Return</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.row{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
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
</style>