<script setup lang="ts">
import NavigationBar from "@/components/global/NavigationBarComponent.vue";
import TopMenu from "@/components/global/TopMenuComponent.vue";
</script>

<template>
  <div class="layout">
    <div class="content">
      <!-- <TopMenu /> -->

      <router-view v-slot="{ Component }">
        <!-- <keep-alive> -->
        <component :is="Component" />
        <!-- </keep-alive> -->
      </router-view>
    </div>
    <NavigationBar />
  </div>
</template>

<style scoped>
.layout {
  height: auto !important; /* real browsers */
  height: 100%; /* IE6: treaded as min-height*/

  min-height: 100%; /* real browsers */
}
.content {
  padding: 1.5rem;
  padding-bottom: 5rem;
}
.spacer {
  margin-bottom: .8rem;
}
</style>