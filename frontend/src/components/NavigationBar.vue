<script setup lang="ts">
import { RouterLink } from "vue-router";
import HomeIcon from "@/components/icons/HomeIcon.vue";
import BooksIcon from "@/components/icons/BooksIcon.vue";
import ProfileIcon from "@/components/icons/ProfileIcon.vue";
</script>

<template>
  <div class="navbar">
    <div class="navbar-items">
      <RouterLink :to="{ name: 'home' }" class="link">
        <HomeIcon />
        <div class="tab-name">Home</div>
      </RouterLink>

      <RouterLink :to="{ name: 'books' }" class="link">
        <BooksIcon />
        <div class="tab-name">Books</div>
      </RouterLink>

      <RouterLink :to="{ name: 'profile' }" class="link">
        <ProfileIcon />
        <div class="tab-name">Profile</div>
      </RouterLink>
    </div>
  </div>
</template>

<style>
.navbar-items {
  display: flex;
  justify-content: space-between;
  gap: 10px;
}
.link {
  text-decoration: none;
  display: block;
  text-align: center;
}
.link:hover .tab-name {
  color: #76CECB;
}
.link:hover svg path {
  fill: #76CECB;
}
.router-link-exact-active {
  color: red  ;
}
.navbar {
  position:fixed;
  width:100%;
  bottom:0; /* stick to bottom */
  background: #FFFFFF;
  box-shadow: 0px 2px 48px rgba(0, 0, 0, 0.13);
  border-radius: 20px 20px 0px 0px;
  padding: 1rem 2rem;
}
.tab-name {
  font-family: 'Roboto';
  font-style: normal;
  font-weight: 700;
  font-size: 10px;
  line-height: 12px;

  text-align: center;
  letter-spacing: 1px;

  color: #9C9C9C; 
}
</style>