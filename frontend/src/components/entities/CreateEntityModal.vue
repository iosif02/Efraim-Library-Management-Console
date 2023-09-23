<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { useEntitiesStore } from '@/stores/entities-store';
import type AuthorModel from '@/models/entities/AuthorModel';
import type { PropType } from 'vue';
import type CategoryModel from '@/models/entities/CategoryModel';
import type PublisherModel from '@/models/entities/PublisherModel';

const props = defineProps({
  title: {
    type: String,
    required: true
  },
  entity: {
    type:  Object as PropType<AuthorModel|CategoryModel|PublisherModel>,
    required: true
  },
  typeEntity: {
    type: String,
    required: true
  }
})

const validateFormAuthor = yup.object({
    name: yup.string().min(5).max(28).required(),
});

const validateFormCategory = yup.object({
    name: yup.string().required(),
    description: yup.string().required(),
    number: yup.number().required(),
});

const validateFormPublisher = yup.object({
    name: yup.string().required(),
    city: yup.string().required(),
});

const store = useEntitiesStore();
const emit = defineEmits(['createEntity', 'hideModal'])

var onSubmit = (entity: any) => {
    if(props.typeEntity == 'Author'){
        store.createAuthor(entity)
        .then(result => {
            if(result){
                emit.call(this, 'createEntity', result);
                store.fetchEntities();
            }
        })
    }

    if(props.typeEntity == 'Category'){
        store.createCategory(entity)
        .then(result => {
            if(result){
                emit.call(this, 'createEntity', result);
                store.fetchEntities();
            }
        });
    }

    if(props.typeEntity == 'Publisher'){
        store.createPublisher(entity)
        .then(result => {
            if(result){
                emit.call(this, 'createEntity', result);
                store.fetchEntities();
            }
        });
    }
};

</script>

<template>
    <div class="overlay">
        <div class="modal">
            <p class="modal-title">{{ props.title }}</p>

            <Form v-if="props.typeEntity == 'Author'" @submit="onSubmit" :validation-schema="validateFormAuthor" :initial-values="props.entity" class="form-control">
                <div class="form-group">
                    <label for="name">Name</label>
                    <Field name="name" />
                    <ErrorMessage name="name" />
                </div>
                <input value="Add" type="submit" class="btn w-100">
            </Form>

            <Form v-if="props.typeEntity == 'Category'" @submit="onSubmit" :validation-schema="validateFormCategory" :initial-values="props.entity" class="form-control">
                <div class="form-group">
                    <label for="name">Name</label>
                    <Field name="name" />
                    <ErrorMessage name="name" />
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <Field name="description" />
                    <ErrorMessage name="description" />
                </div>
                <div class="form-group">
                    <label for="number">Number</label>
                    <Field name="number" type="number" />
                    <ErrorMessage name="number" />
                </div>
                <input value="Add" type="submit" class="btn w-100">
            </Form>

            <Form v-if="props.typeEntity == 'Publisher'" @submit="onSubmit" :validation-schema="validateFormPublisher" :initial-values="props.entity" class="form-control">
                <div class="form-group">
                    <label for="name">Name</label>
                    <Field name="name" />
                    <ErrorMessage name="name" />
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <Field name="city" />
                    <ErrorMessage name="city" />
                </div>
                <input value="Add" type="submit" class="btn w-100">
            </Form>

            <button class="btn w-100 cancel" @click="$emit('hideModal')">Cancel</button>
        </div>
    </div>
    
    <Loading v-if="store.isLoading" />
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
.cancel{
    border: 1px solid #D0D5DD;
    background-color: white;
    color: #344054;
    margin: 0;
}
</style>