<script setup lang="ts">
import { reactive } from 'vue';
import ChevronRightIcon from "@/components/icons/ChevronRightIcon.vue"

const props = defineProps({
  list: {
    type: Array,
    default: [],
    required: true
  },
  title: {
    type: String,
    default: 'List'
  },
  showCount: {
    type: Boolean,
    default: false
  }
});
</script>

<template>
  <div class="list">
    <div class="list-header">
      <div class="list-title" v-if="props.title">
        {{ props.title }}
        <span class="list-count" v-if="showCount">({{ list.length }})</span>
      </div>
      <ChevronRightIcon />
    </div>
  </div>
</template>

<style>
.list-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.list-title {
  font-family: 'Roboto';
  font-style: normal;
  font-weight: 500;
  font-size: 14px;
  line-height: 28px;

  color: #2B2E3C;
}
.list-count {
  color: #AAAAAA;
}
</style>