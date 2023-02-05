<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import { authStore } from '@/stores/auth-store';
import { useRouter } from "vue-router";
import * as yup from 'yup';

const router = useRouter();
const store = authStore();

async function register(model: any): Promise<void> {
	let result = await store.register(model);
	if(result) router.replace({ name: "login" });
}

const validateForm = yup.object({
	name: yup.string().required(),
	email: yup.string().required().email(),
	password: yup.string().required().min(8),
	password_confirmation: yup.string().required().oneOf([yup.ref('password')], 'Passwords do not match')
});
</script>

<template>
	<h2 class="auth-title">Create Account</h2>
	<Form class="form-control" @submit="register" :validation-schema="validateForm">
		<div class="form-group">
			<p>Name</p>
			<Field name="name" type="text" />
			<ErrorMessage name="name" />
		</div>
		<div class="form-group">
			<p>Email</p>
			<Field name="email" type="email" />
			<ErrorMessage name="email" />
		</div>
		<div class="form-group">
			<p>Password</p>
			<Field name="password" type="password" />
			<ErrorMessage name="password" />
		</div>
		<div class="form-group">
			<p>Confirm Password</p>
			<Field name="password_confirmation" type="password" />
			<ErrorMessage name="password_confirmation" />
		</div>
		<input type="submit" value="Register" class="btn w-100">
		<p class="small-text">
			Already have an account?
			<RouterLink :to="{ name: 'login' }">Login here</RouterLink>
		</p>
	</Form>
</template>

<style scoped>
	.small-text {
		font-size: .75rem;
		text-align: center;
	}
</style>