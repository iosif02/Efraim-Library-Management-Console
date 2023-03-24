<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { useUsersStore } from '@/stores/user-store';
import router from '@/router';

const props = defineProps({
  id: String
})

if(!props.id || props.id == '0' || !parseInt(props.id)){
  router.back();
}

const store = useUsersStore();
store.fetchSelectedUser(props.id || '')

const validateForm = yup.object({
    name: yup.string().required(),
    email: yup.string().required().email(),
    password: yup.string().min(8),
    identity_number: yup.number().required(),
    first_name: yup.string().required(),
    last_name: yup.string().required(),
    address: yup.string().required(),
    phone: yup.number().required(),
    occupation: yup.string().required(),
    birth_date: yup.date().required(),
});

var onSubmit = (user: any) => {
  user.password ?? delete user.password;
  user.userId = props.id
  store.updateUser(user)
  .then(result => {
    if(result)
      router.back();
      store.fetchUsers();
  });
}
</script>

<template>
  <Loading v-if="store.isLoading" />

	<div>
    <GoBack goBackText="Category"/>
	</div>

  <Form @submit="onSubmit" :validation-schema="validateForm" :initial-values="{...store.user, ...store.user.user_details}" class="form-control">
    <div class="form-group">
      <label for="name">Name</label>
      <Field name="name" />
      <ErrorMessage name="name" />
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <Field name="email" />
      <ErrorMessage name="email" />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <Field name="password" />
      <ErrorMessage name="password" />
    </div>
    <div class="form-group">
      <label for="identity_number">Identity number</label>
      <Field name="identity_number" type="number" />
      <ErrorMessage name="identity_number" />
    </div>
    <div class="form-group">
      <label for="first_name">First name</label>
      <Field name="first_name" />
      <ErrorMessage name="first_name" />
    </div>
    <div class="form-group">
      <label for="last_name">Last name</label>
      <Field name="last_name" />
      <ErrorMessage name="last_name" />
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <Field name="address" />
      <ErrorMessage name="address" />
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <Field name="phone" type="number" maxlength="2"/>
      <ErrorMessage name="phone" />
    </div>
    <div class="form-group">
      <label for="occupation">Occupation</label>
      <Field name="occupation" />
      <ErrorMessage name="occupation" />
    </div>
    <div class="form-group">
      <label for="birth_date">Birth date</label>
      <Field name="birth_date" type="date" />
      <ErrorMessage name="birth_date" />
    </div>
    <input value="Edit" type="submit" class="btn w-100">
  </Form>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
</style>