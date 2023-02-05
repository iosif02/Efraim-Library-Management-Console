<script setup lang="ts">
defineProps({
    routeName: {
        type: String,
        required: true
    }
})
</script>

<template>
    <RouterLink :to="{ name: routeName }" class="link">
        <div class="button"></div>
    </RouterLink>
</template>

<style scoped>
.button {
    background-color: #76CECB;
    width: 55px;
    height: 55px;
    position: absolute;
    right: 16px;
    bottom: 76px;
    border-radius: 50%;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.25);
}
.button::before, .button::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 2px solid #FFFFFF;
    width: 20px;
}
.button::after {
    width: 0;
    height: 20px;
}
</style>