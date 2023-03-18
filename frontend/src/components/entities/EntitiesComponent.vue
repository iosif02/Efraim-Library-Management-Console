<script setup lang="ts">
defineProps({
    title:{
        type: String,
        required: true
    },
    Icon: {
        required: true
    }
});
</script>

<template>
    <div class="container">
        <Icon />
        <p class="container-title">{{ title }}</p>
    </div>
</template>

<style scoped>
.container{
  display: flex;
  flex-direction: row;
  align-items: center;
  padding-left: 12px;
  width: 100%;
  height: 48px;
  border-radius: 12px;
  background: #FFFFFF;
  box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.06), 4px 2px 48px rgba(0, 0, 0, 0.12);
  border-radius: 12px;
}
.container-title{
  padding-left: 15px;
  font-family: 'Roboto-500';
  font-style: normal;
  font-size: 14px;
  line-height: 20px;
  color: #6D727A;
}
</style>