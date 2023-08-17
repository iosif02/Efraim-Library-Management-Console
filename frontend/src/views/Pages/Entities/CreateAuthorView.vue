<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { useEntitiesStore } from '@/stores/entities-store';
import router from '@/router';

const store = useEntitiesStore();

const validateForm = yup.object({
    name: yup.string().min(5).max(28).required(),
});

var onSubmit = (author: any) => {
  store.createAuthor(author)
  .then(result => {
    if(result){
      store.fetchAuthors();
      router.back();
    }
  });
}
</script>

<template>
  <Loading v-if="store.isLoading" />

	<div>
    <GoBack goBackText="Add Author"/>
	</div>

  <Form @submit="onSubmit" :validation-schema="validateForm" class="form-control">
    <div class="form-group">
      <label for="name">Name</label>
      <Field name="name" />
      <ErrorMessage name="name" />
    </div>
    <input value="Add" type="submit" class="btn w-100">
  </Form>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>