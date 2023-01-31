<script setup lang="ts">
import moment from 'moment';

const props = defineProps(['books'])

let formatDate = (date: string) => {
    if (date) {
        return moment(date, "DD-MM-YY h:mm:ss").format("DD MMM");
    }
    return date;
}
let delayedDays = (date: string) => {
    if (date) {
        const currentDate = new Date();
        const oneDay = 24 * 60 * 60 * 1000;

        let newDate = new Date(moment(date, "DD-MM-YY h:mm:ss").toString());
        let days = currentDate.getTime() - newDate.getTime();

        return Math.ceil(days / oneDay) - 1;
    }
    return 10;
}
</script>

<template>
    <div class="books">
        <div v-for="book in props?.books" class="book">
            <img :src="book.PhotoUrl" alt="">
            <div class="details">
                <div class="top-section">
                    <p class="name">{{ book.UserName }}</p>
                    <p class="date">{{ formatDate(book.DueDate) }} - {{ delayedDays(book.DueDate) }} days</p>
                </div>
                <div class="book-title">{{ book.BookTitle }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.category-title {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}
.title {
    font-family: 'Roboto-500';
    color: #2B2E3C;
}
.book {
    background-color: #F6F6F6;
    border-radius: 8px;
    padding: 8px;
    display: flex;
    column-gap: 8px;
    margin-bottom: 3px;
}
.details {
    width: calc(100% - 48px);
}
.name {
    font-size: 16px;
    font-family: 'Roboto-500';
    color: #2B2E3C;
}
img {
    height: 40px;
    width: 40px;
    object-fit: contain;
}
.top-section {
    display: flex;
    justify-content: space-between;
}
.book-title {
    margin-top: 5px;
    font-size: 12px;
}
.date {
    font-size: 12px;
}
</style>