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
store.fetchSelectedAuthor(props.id || '');

const validateForm = yup.object({
    name: yup.string().min(5).max(28).required(),
});

var onSubmit = (author: any) => {
  author.authorId = props.id
  store.updateAuthor(author)
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
    <GoBack goBackText="Edit Author"/>
	</div>

  <Form @submit="onSubmit" :validation-schema="validateForm" :initial-values="store.author" class="form-control">
    <div class="form-group">
      <label for="name">Name</label>
      <Field name="name" />
      <ErrorMessage name="name" />
    </div>
    <input value="Save" type="submit" class="btn w-100">
  </Form>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>