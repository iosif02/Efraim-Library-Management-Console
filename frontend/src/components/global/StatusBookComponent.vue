<script setup lang="ts">
defineProps({
    status:{
        type: Number,
        required: true
    },
    route: {
        type: String
    }
})
</script>

<template>
    <div :class="{ 'goodStatus': status > 0, 'badStatus': status == 0, 'defaultStatus': route == 'editBook' }">{{ status > 0 ? 'Available' : 'Borrowed' }}</div>
</template>

<style scoped>
.goodStatus {
    font-size: 12px;
    color: #76CE9F;
    background-color: #DCF2E7;
    border-radius: 22px;
    padding: 5px 10px 5px 20px;
    position: relative;
    top: -8px;
}
.goodStatus::before {
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
.badStatus{
    font-size: 12px;
    color: #eb9b00;
    background-color: #f3e2c1;
    border-radius: 22px;
    padding: 5px 10px 5px 20px;
    position: relative;
    top: -8px;
}
.badStatus::before{
    content: '';
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 5px;
    height: 5px;
    background: #eb9b00;
    border-radius: 50%;
    left: 10px;
}
.defaultStatus{
    top: 0px;
}
</style>