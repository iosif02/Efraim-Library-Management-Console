<script setup lang="ts">
const props = defineProps({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  action: {
    type: String,
    required: true
  }
})
</script>

<template>
    <div class="overlay">
        <div class="modal">
            <p class="modal-title">{{ props.title }}</p>
            <p class="description">{{ props.description }}</p>

            <button class="btn w-100 confrim" @click="$emit('submit')">{{ props.action }}</button>
            <button class="btn w-100 cancel" @click="$emit('cancel')">Cancel</button>
        </div>
    </div>
</template>

<style scoped>
.overlay {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9;

    width: 100%;
    height: 100%;
    position: fixed;
    background-color: rgba(60, 60, 60, 0.5);
    /* background-color: black;
    opacity: .2; */
}
.modal {
    /* height: 30%; */
    width: 90%;
    border-radius: 12px;
    background-color: white;
    padding: 20px 16px 16px;    
}
.modal-title{
    font-family: 'Arial';
    font-style: normal;
    font-weight: 600;
    font-size: 18px;
    line-height: 28px;
    text-align: center;
    text-transform: capitalize;
    color: #101828;
}
.description{
    font-family: 'Arial';
    font-style: normal;
    font-weight: 400;
    font-size: 14px;
    line-height: 20px;
    text-align: center;
    color: #667085;
    margin-top: 8px;
}
.confrim{
    margin-top: 24px;
}
.cancel{
    border: 1px solid #D0D5DD;
    background-color: white;
    color: #344054;
    margin: 0;
}
</style>