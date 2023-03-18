<script setup lang="ts">
import type UserModel from '@/models/user/UserModel';
import ChevronRightIcon from "@/components/icons/ChevronRightIcon.vue";
import type { PropType } from 'vue'

defineProps({
    users: {
        type: Object as PropType<UserModel[]>,
        required: true
    }
});
</script>

<template>
    <div class="users">
        <div 
            v-for="(user, index) in users" class="user-section" 
            :class="{ 'borderTop': index != 0, 'paddingTop': index != 0}" 
            @click="$emit('openModal', user.id)"
            :key="index" 
        >
            <div class="right-section">
                <div class="user-image">
                    <img :src="user.user_details?.photo_url ?? '/img/user.jpg'" alt="user-image">
                </div>
                <div class="about-section">
                    <p class="user-name">{{ user.user_details?.first_name + ' ' + user.user_details?.last_name}}</p>
                    <p class="user-status">{{ user.transaction_count }} book</p>
                </div>
            </div>
            <div class="arrow">
                <ChevronRightIcon />
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
}
.right-section{
    display: flex;
    flex-direction: row;
}
.user-image{
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
}
.user-name{
    font-family: 'Roboto-400';
    font-style: normal;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 0.77px;
    color: #333333;
}
.user-status{
    font-family: 'Roboto-400';
    font-style: normal;
    font-size: 14px;
    line-height: 16px;
    letter-spacing: 0.77px;
    color: #8A8A8A;
    margin-top: 5px;
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
</style>