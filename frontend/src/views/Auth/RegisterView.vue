<template>
	<h2 class="auth-title">Create Account</h2>
	<Form class="form-control" @submit="register">
		<div class="form-group">
			<p>Name</p>
			<Field name="name" type="text" :rules="validateName" />
			<ErrorMessage name="name" />
		</div>
		<div class="form-group">
			<p>Email</p>
			<Field name="email" type="email" :rules="validateEmail" />
			<ErrorMessage name="email" />
		</div>
		<div class="form-group">
			<p>Password</p>
			<Field name="password" type="password" :rules="validatePassword" />
			<ErrorMessage name="password" />
		</div>
		<div class="form-group">
			<p>Confirm Password</p>
			<Field name="password_confirmation" type="password" :rules="validatePassword" />
			<ErrorMessage name="password_confirmation" />
		</div>
		<input type="submit" value="Register" class="btn w-100">
		<p class="small-text">Already have an account? <RouterLink :to="{ name: 'login' }">Login here</RouterLink></p>
	</Form>
</template>

<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import { authStore } from '@/stores/authStore';
import { useRouter } from "vue-router";
import type RegisterModel from '@/models/auth/RegisterModel';

const router = useRouter();
const store = authStore();

async function register(model: RegisterModel): Promise<void> {
	let result = await store.register(model);

	if(result) {
		router.push({ name: "login" })
	}
}

function validateEmail(value: string): string|boolean {
	if (!value) {
		return 'This field is required';
	}

	const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (!regex.test(value)) {
		return 'This field must be a valid email';
	}

	return true;
}

function validateName(value: string): string|boolean {
	if(!value) {
		return 'This field is required';
	}

	return true;
}

function validatePassword(value: string): string|boolean {
	if(!value) {
		return 'This field is required';
	}

	return true;
}
</script>

<style scoped>
	.small-text {
		font-size: .75rem;
		text-align: center;
	}
</style>