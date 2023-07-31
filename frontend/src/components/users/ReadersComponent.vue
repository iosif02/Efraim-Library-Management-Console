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


function getRandomColor() {
    const red = Math.floor(Math.random() * 256);
    const green = Math.floor(Math.random() * 256);
    const blue = Math.floor(Math.random() * 256);
    return `#${red.toString(16).padStart(2, '0')}${green.toString(16).padStart(2, '0')}${blue.toString(16).padStart(2, '0')}`;
}

function getNameIntial(first_initial: String, second_initial: String) {
    if(first_initial == second_initial) return first_initial;
    return first_initial + '' + second_initial;
}
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
                <div class="user-image" :style="{ backgroundColor: getRandomColor() }">
                    <p>{{ getNameIntial(user.first_name[0], user.last_name[0]) }}</p>
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
    border-radius: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.user-image p{
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
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