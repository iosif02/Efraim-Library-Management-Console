<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { useEntitiesStore } from '@/stores/entities-store';
import router from '@/router';

const props = defineProps({
  id: String
})

if(!props.id || props.id == '0' || !parseInt(props.id)){
  router.back();
}

const store = useEntitiesStore();
store.fetchSelectedCategory(props.id || '');

const validateForm = yup.object({
    name: yup.string().required(),
    description: yup.string().required(),
    number: yup.number().required(),
});

var onSubmit = (category: any) => {
  category.categoryId = props.id
  store.updateCategory(category)
  .then(result => {
    if(result){
      store.fetchCategories();
      router.back();
    }
  });
}
</script>

<template>
  <Loading v-if="store.isLoading" />

	<div>
    <GoBack goBackText="Edit Category"/>
	</div>

  <Form @submit="onSubmit" :validation-schema="validateForm" :initial-values="store.category" class="form-control">
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
    <input value="Save" type="submit" class="btn w-100">
  </Form>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>