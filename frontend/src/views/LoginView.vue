<template>
		<Form @submit="login">
		<div>
			<p>Email</p>
			<Field name="email" type="email" :rules="validateEmail" />
			<ErrorMessage name="email" />
		</div>
		<div>
			<p>Password</p>
			<Field name="password" type="password" />
			<ErrorMessage name="password" />
		</div>
		<button>Login</button>
	</Form>
</template>

<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import { authStore } from '@/stores/authStore';
import { useRouter } from "vue-router";

// const props = defineProps({
// 	userCreated: {
// 		type: Boolean,
// 		default: false
// 	}
// });
const store = authStore();
const router = useRouter();


async function login(model: any): Promise<void> {
	let result = await store.login(model);

	if(result) {
		// router.push({ name: "login" })
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