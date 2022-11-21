<template>
	<div>
    <VTabs :tabs="tabs" :active="activeTab" />
    <div class="spacer"></div>
    <SearchBar />
    <div class="spacer"></div>
    <VList title="Custom Title" :showCount="true" />
	</div>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>

<script setup lang="ts">
import { reactive, watch } from 'vue';
import { booksStore } from '@/stores/booksStore';
import SearchBar from '@/components/SearchBar.vue'
import VTabs from '@/components/VTabs.vue';
import VList from '@/components/VList.vue';
import type TabModel from '@/models/nav/TabModel';

const store = booksStore();
let books = await store.fetchBooks();


const tabs: TabModel[] = reactive([]);
tabs.push({
  name: 'Titles',
})
tabs.push({
  name: 'Readers'
})
tabs.push({
  name: 'Authors'
})

let activeTab: TabModel = reactive({...tabs[1]});
</script>