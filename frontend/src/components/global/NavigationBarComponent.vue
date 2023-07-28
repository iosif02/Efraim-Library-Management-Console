<script setup lang="ts">
import { RouterLink } from "vue-router";
import HomeIcon from "@/components/icons/HomeIcon.vue";
import BooksIcon from "@/components/icons/BooksIcon.vue";
import ProfileIcon from "@/components/icons/ProfileIcon.vue";
import EntityIcon from "@/components/icons/EntityIcon.vue";
</script>

<template>
  <div class="navbar">
    <div class="navbar-items">
      <RouterLink :to="{ name: 'home', replace: true }" class="link">
        <HomeIcon />
        <div class="tab-name">Home</div>
      </RouterLink>

      <RouterLink :to="{ name: 'book', replace: true }" class="link">
        <BooksIcon />
        <div class="tab-name">Books</div>
      </RouterLink>

      <RouterLink :to="{ name: 'entity', replace: true} " class="link">
        <EntityIcon />
        <div class="tab-name">Entities</div>
      </RouterLink>

      <RouterLink :to="{ name: 'users', replace: true }" class="link">
        <ProfileIcon />
        <div class="tab-name">User</div>
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
  width: 100%;
}
.link svg{
  padding: 5px 0px;
  box-sizing: content-box;
  transition: 0.5s;
}

.router-link-active:not(:nth-child(3)) svg path,
.router-link-active div
{
  fill: #fff;
  transition: 0.5s;
  /* color: #fff; */
}

.router-link-active:nth-child(3) svg path:nth-child(1){
  stroke: #fff;
  transition: 0.5s;
}

.router-link-active:nth-child(3) svg path:nth-child(3),
.router-link-active:nth-child(3) svg path:nth-child(5)
{
  fill: #fff;
  transition: 0.5s;
}

.router-link-active svg{
  width: 90%;
  border-radius: 100px;
  background-color: #76CECB;
}

.router-link-active div{  
  font-weight: 700;
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
  font-size: 10px;
  line-height: 12px;
  text-align: center;
  letter-spacing: 1px;
  color: #9C9C9C; 
}
</style>