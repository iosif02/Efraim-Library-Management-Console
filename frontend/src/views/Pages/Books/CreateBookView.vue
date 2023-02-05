<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';

const validateForm = yup.object({
    // title: yup.string().required(),
    // category_id: yup.string().required(),
    // year: yup.string(),
    // price: yup.number(),
    // image: yup.string(),
    // quantity: yup.number(),
    // published_id: yup.number()
});

var onSubmit = (values: any) => {
    console.log(values);
}

var drinks = [1, 2, 3];
</script>

<template>
    <GoBack go-back-text="Create Book" />

    <Form @submit="onSubmit" :validation-schema="validateForm" class="form-control">
        <div class="form-group">
            <Field name="title" />
            <ErrorMessage name="title" />
        </div>
        <div class="form-group">
            <Field v-slot="{ value }" name="category_id" as="select" multiple>
                <option value="" disabled>Select a drink</option>
                <option v-for="drink in drinks" :key="drink" :value="drink" :selected="value && value.includes(drink)">{{ drink }}</option>
            </Field>
            <ErrorMessage name="category_id" />
        </div>
        <div class="form-group">
            <Field name="year" />
            <ErrorMessage name="year" />
        </div>
        <div class="form-group">
            <Field name="price" />
            <ErrorMessage name="price" />
        </div>
        <div class="form-group" as="image">
            <Field name="image" />
            <ErrorMessage name="image" />
        </div>
        <div class="form-group">
            <Field name="quantity" />
            <ErrorMessage name="quantity" />
        </div>
        <div class="form-group">
            <Field v-slot="{ value }" name="published_id" as="select" multiple>
                <option value="" disabled>Select a drink</option>
                <option v-for="drink in drinks" :key="drink" :value="drink" :selected="value && value.includes(drink)">{{ drink }}</option>
            </Field>
            <ErrorMessage name="published_id" />
        </div>

        <input value="Sign In" type="submit" class="btn w-100">
    </Form>
</template>

<style scoped>
</style>