<script setup lang="ts">
import { RouterLink } from "vue-router";
</script>

<template>
    <div class="navbar-items">
        <RouterLink :to="{ name: 'home' }" class="link">
            <font-awesome-icon icon="fa-solid fa-house-user" class="icon" />
            <div>Home</div>
        </RouterLink>

        <RouterLink :to="{ name: 'books' }" class="link">
            <font-awesome-icon icon="fa-solid fa-book" class="icon" />
            <div>Books</div>
        </RouterLink>

        <RouterLink :to="{ name: 'profile' }" class="link">
            <font-awesome-icon icon="fa-solid fa-user" class="icon" />
            <div>Profile</div>
        </RouterLink>
    </div>
</template>

<style scoped>
.navbar-items {
    display: flex;
    justify-content: space-evenly;
    gap: 10px;
}
.link {
    text-decoration: none;
    display: block;
    text-align: center;
}
.router-link-exact-active {
    color: red  ;
}
</style>