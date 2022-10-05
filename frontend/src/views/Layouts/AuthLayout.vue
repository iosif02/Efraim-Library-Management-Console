<script setup lang="ts">
    import { RouterLink, RouterView } from "vue-router";
</script>

<template>
    <main>
        <div class="responsive-auth">
            <RouterView />
        </div>
    </main>
</template>

<style scoped>
    main {
        height: 100%;
        display: flex;
        justify-content: center;
    }
    .responsive-auth {
        width: 70vw;
        max-width: 20rem;
        min-width: 5rem;
    }
</style>
    