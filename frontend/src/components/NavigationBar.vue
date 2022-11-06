<script setup lang="ts">
import { RouterLink } from "vue-router";
</script>

<template>
    <div class="navbar-items">
        <div class="item">
            <font-awesome-icon icon="fa-solid fa-house-user" class="icon" />
            <RouterLink :to="{ name: 'home' }" class="link">Home</RouterLink>
        </div>
        <div class="item">
            <font-awesome-icon icon="fa-solid fa-book" class="icon" />
            <RouterLink :to="{ name: 'books' }" class="link">Books</RouterLink>
        </div>
        <div class="item">
            <font-awesome-icon icon="fa-solid fa-user" class="icon" />
            <RouterLink :to="{ name: 'profile' }" class="link">Profile</RouterLink>
        </div>
    </div>
</template>

<style scoped>
.navbar-items {
    display: flex;
    justify-content: space-evenly;
    gap: 10px;
}
.item {
    text-align: center;
}
.link {
    text-decoration: none;
    display: block;
}
.router-link-exact-active {
    color: red  ;
}
</style>