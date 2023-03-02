<script setup lang="ts">
import type BookModel from '@/models/book/BookModel';
import type { PropType } from 'vue'
import { RouterLink } from "vue-router";
import StatusBookComponent from '@/components/global/StatusBookComponent.vue';

defineProps({
    books: {
        type: Object as PropType<BookModel[]>,
        required: true
    }
});
</script>

<template>
    <div class="books">
        <div v-for="book in books" class="book">
            <img :src="book.image" alt="">
            <div class="details">
                <div class="top-section">
                    <div class="title">{{ book.title }}</div>
                    <StatusBookComponent :status="book.status" route="editBook"/>   
                </div>
                <div class="bottom-section">
                    <div class="author">{{ book.authors?.[0]?.name }}</div>
                    <div class="edit">
                        <div class="category">
                            <span class="category-number">({{ book.category?.number }})</span>
                            <span class="category-name">{{ book.category?.name }}</span>
                        </div>
                        <div class="btnLink">
                            <RouterLink :to="{ name: 'editBook', params: { id: book.id } }">
                                <button class="btnEdit">Edit</button>
                            </RouterLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.book {
    display: flex;
    width: 100%;
    margin-bottom: 25px;
}
img {
    width: 83px;
    height: 90px;
    border-radius: 12px;
    object-fit: cover;
    margin-right: 16px;
}
.details {
    width: calc(100% - 99px);
}
.top-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 5px;
}
.title {
    font-family: 'Roboto-400';
    color: #2B2E3C;
    font-size: 16px;
    font-weight: 600;
}
.author {
    margin-bottom: 10px;
    color: #8A8A8A;
}
.category {
    display: flex;
}
.category-number {
    font-size: 12px;
    color: #76CECB;
    margin-right: 6px;
}
.category-name {
    color: #ACB1B6;
    font-size: 13px;
}
.status {
    font-size: 12px;
    color: #76CE9F;
    background-color: #DCF2E7;
    border-radius: 22px;
    padding: 5px 10px 5px 20px;
    position: relative;
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
.edit{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.btnEdit{
    width: 69px;
    height: 24px;
    background: #76CECB;
    border-radius: 7px;
    border: none;

    font-family: 'Roboto-400';
    font-style: normal;
    font-size: 14px;
    line-height: 15px;
    color: #FFFFFF;
}
.btnLink{
    position: relative;
    bottom: -10px;
}
</style>