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
store.fetchSelectedPublisher(props.id || '');

const validateForm = yup.object({
    name: yup.string().required(),
    city: yup.string().required(),
});

var onSubmit = (publisher: any) => {
  publisher.publisherId = props.id
  store.updatePublisher(publisher)
  .then(result => {
    if(result)
      store.fetchPublishers();
      router.back();
  });
}
</script>

<template>
  <Loading v-if="store.isLoading" />

	<div>
    <GoBack goBackText="Publisher"/>
	</div>

  <Form @submit="onSubmit" :validation-schema="validateForm" :initial-values="store.publisher" class="form-control">
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
    <input value="Create" type="submit" class="btn w-100">
  </Form>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>