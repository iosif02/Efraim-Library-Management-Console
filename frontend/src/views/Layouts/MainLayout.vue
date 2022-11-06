<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
import NavigationBar from "@/components/NavigationBar.vue";
</script>

<template>
    <div class="layout">
        <div class="header"></div>
        <div class="content">
            <RouterView />
        </div>
        <div class="navbar">
            <NavigationBar />
        </div>
    </div>
</template>

<style scoped>
.layout {
    height: 100vh;
    display: grid;
    grid-template-rows: auto 1fr auto;
}
.content {
    overflow-y: scroll;
}
.navbar {
    padding: 15px 20px 10px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
}
</style>
    