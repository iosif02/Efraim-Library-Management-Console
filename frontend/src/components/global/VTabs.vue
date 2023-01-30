<script setup lang="ts">
import type TabModel from '@/models/nav/TabModel';
import { reactive } from 'vue';

const props = defineProps(['active', 'tabs'])

let tabRefs: { [key: string]: any } = reactive({});

function setTab(tab: TabModel) {
  if(!checkTab(tab)) {
    console.log('Invalid tab', props.tabs);
    return;
  }
  Object.assign(props.active, tab)
  emits('update:active', {...tab});
  scrollToTab(tab);
}
function checkTab(tab: TabModel) {
  return props.tabs.find((tb: TabModel) => tb.name === tab.name);
}
function scrollToTab(tab: TabModel) {
  tabRefs[tab.name].scrollIntoView({ behavior: 'smooth' })
}
const emits = defineEmits<{(e: 'update:active', tab: TabModel): void }>();
</script>

<template>
  <div class="navtab">
    <div class="navtab-items">
      <div v-for="tab in props.tabs" :ref="el => { tabRefs[tab.name] = el }" class="navtab-item" :class="tab.name === props.active.name ? 'active' : ''" @click="() => setTab(tab)">{{ tab.name }}</div>
      
      <component :is='props.active.component'></component>
    </div>
  </div>
</template>

<style scoped>
.navtab-items {
  display: flex;
  justify-content: space-between;
  align-items: center;
  overflow-x: auto;
  transition: .75s;
  padding-bottom: .5rem;
}
.navtab-item {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 400;
  font-size: 14px;
  line-height: 21px;
  /* identical to box height */

  letter-spacing: -0.165px;

  color: #AAAAAA;
  padding: .5rem 2.5rem;
}
.navtab-item.active {
  background: #76CECB;
  border-radius: 20px;
  padding: .5rem 3.5rem;
  color: white;
}
</style>