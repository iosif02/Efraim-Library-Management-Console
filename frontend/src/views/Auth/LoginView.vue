<script setup lang="ts">
import { RouterLink } from "vue-router";
import { Form, Field, ErrorMessage } from 'vee-validate';
import { authStore } from '@/stores/auth-store';
import * as yup from 'yup';

defineProps({
	userCreated: {
		type: Boolean,
		default: false
	}
});

const store = authStore();
async function login(model: any): Promise<void> {
	let result = await store.login(model);
	if(result) location.reload();
}

const validateForm = yup.object({
  email: yup.string().required().email(),
  password: yup.string().required().min(8),
});
</script>

<template>
	<h2 class="auth-title">Login</h2>
	<Form class="form-control" @submit="login" :validation-schema="validateForm">
		<div class="form-group">
			<label>Email</label>
			<Field name="email" type="email" />
			<ErrorMessage name="email" />
		</div>
		<div class="form-group">
			<label>Password</label>
			<Field name="password" type="password" />
			<ErrorMessage name="password" />
		</div>
		<input value="Sign In" type="submit" class="btn w-100">
		<p class="small-text">
			You don't have an account?
			<RouterLink :to="{ name: 'register' }">Register here</RouterLink>
		</p>
	</Form>
</template>

<style scoped>
	.small-text {
		font-size: .75rem;
		text-align: center;
	}
</style>