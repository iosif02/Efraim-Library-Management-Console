<script setup lang="ts">
import { RouterLink } from "vue-router";
</script>

<template>
    <div class="top-menu">
        <RouterLink :to="{ name: 'home' }" class="link">
            <div class="link-name">Titles</div>
        </RouterLink>
        <RouterLink :to="{ name: 'readers' }" class="link">
            <div class="link-name">Readers</div>
        </RouterLink>
        <RouterLink :to="{ name: 'authors' }" class="link">
            <div class="link-name">Authors</div>
        </RouterLink>
    </div>
</template>

<style scoped>
.top-menu {
    /* display: flex;
    justify-content: space-between; */
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    margin-bottom: 20px;
}
.link {
    align-self: center;
}
.router-link-active {
    background-color: #76CECB;
    border-radius: 20px;
    padding: 10px 0;
}
.router-link-active .link-name {
    color: white;
}
</style>