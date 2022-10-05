<template>
	<h2 class="auth-title">Login</h2>
	<Form class="form-control" @submit="login">
		<div class="form-group">
			<label>Email</label>
			<Field name="email" type="email" :rules="validateEmail" />
			<ErrorMessage name="email" />
		</div>
		<div class="form-group">
			<label>Password</label>
			<Field name="password" type="password" />
			<ErrorMessage name="password" />
		</div>
		<input value="Sign In" type="submit" class="btn w-100">
		<p class="small-text">You don't have an account? <RouterLink :to="{ name: 'register' }">Register here</RouterLink></p>
	</Form>
</template>

<script setup lang="ts">
import { RouterLink } from "vue-router";
import { Form, Field, ErrorMessage } from 'vee-validate';
import { authStore } from '@/stores/authStore';
import { useRouter } from "vue-router";



const props = defineProps({
	userCreated: {
		type: Boolean,
		default: false
	}
});
const store = authStore();
const router = useRouter();


async function login(model: any): Promise<void> {
	let result = await store.login(model);
	
	if(result) {
		router.push({ name: "home" })
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
</script>

<style scoped>
	.small-text {
		font-size: .75rem;
		text-align: center;
	}
</style>