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

const backgroundColor = [
    'background-color: #001219;',
    'background-color: #005F73;',
    'background-color: #0A9396;',
    'background-color: #94D2BD;',
    'background-color: #E9D8A6;',
    'background-color: #EE9B00;',
    'background-color: #CA6702;',
    'background-color: #BB3E03;',
    'background-color: #AE2012;',
    'background-color: #9B2226;',
]

function getRandomColor() {
    const randomNumber = Math.floor(Math.random() * 10)
    return backgroundColor[randomNumber]
}

function getNameIntial(first_initial: String, second_initial: String) {
    if(first_initial == second_initial) return first_initial;
    return first_initial + '' + second_initial;
}
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
                <div class="user-image" :style="getRandomColor()">
                    <p>{{ getNameIntial(user.first_name[0], user.last_name[0]) }}</p>
                </div>
                <div class="about-section">
                    <p class="user-name">{{ user.first_name + ' ' + user.last_name}}</p>
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
    gap: 1rem;
}
.right-section{
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
p{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>