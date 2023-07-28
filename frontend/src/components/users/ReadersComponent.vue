<script setup lang="ts">
import type UserModel from '@/models/user/UserModel';
import type { PropType } from 'vue'
defineProps({
    users: {
        type: Object as PropType<UserModel[]>,
        required: true
    },
    routeName: {
        type: String,
        required: false
    }
});
</script>

<template>
    <div class="users">
        <div 
            v-for="(user, index) in users" 
            class="user-section" 
            :class="{ 'borderTop': index != 0, 'paddingTop': index != 0}" 
            :key="index" 
        >
            <div class="left-section">
                <div class="user-image">
                    <img :src="user.user_details?.photo_url ?? '/img/user.jpg'" alt="user-image">
                </div>
                <div class="about-section">
                    <p class="user-name">{{ user.first_name + ' ' + user.last_name}}</p>
                    <p class="user-status">{{ user.transaction_count }} book</p>
                </div>
            </div>
            <div class="container-btn">
                <button class="btn-edit" @click="$router.push({ name: routeName, params: { id: user.id } })">Edit</button>
                <button class="btn-delete" @click="$emit('openModal', user.id)">Delete</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.user-section{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    height: 65px;
    width: 100%;
    gap: 1rem;
}
.left-section{
    display: flex;
    flex-direction: row;

    overflow: hidden;
}
.user-image{
    min-width: 42px;
    width: 42px;
    height: 42px;
}
.user-image img{
    object-fit: cover;
    height: 100%;
    width: 100%;
    border-radius: 200px;
}
.about-section{
    display: flex;
    flex-direction: column;
    margin-left: 20px;
    
    overflow: hidden;
}
.user-name{
    font-family: 'Roboto-400';
    font-style: normal;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 0.77px;
    color: #333333;

    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.user-status{
    font-family: 'Roboto-400';
    font-style: normal;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 0.77px;
    color: #8A8A8A;
    margin-top: 5px;

    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.arrow{
    display: flex;
    justify-content: center;
    align-items: center;
    padding-bottom: 20px;
    box-sizing: border-box;
}
.borderTop{
    border-top: 1px solid #E7E7E7;;
}
.paddingTop{
    padding-top: 18px;
    box-sizing: content-box;
}
.container-btn{
    display: flex;
    flex-wrap: nowrap;
}
</style>