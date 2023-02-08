<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { ref, watchEffect } from 'vue';
import { useBooksStore } from '@/stores/books-store';
import { useAuthorsStore } from '@/stores/authors-store';
import type AuthorModel from '@/models/author/AuthorModel';
import type CategoryModel from '@/models/book/CategoryModel';

const authorsStore = useAuthorsStore();
const booksStore = useBooksStore();

if(!authorsStore.authors.length) {
    authorsStore.fetchAuthors();
}
if(!booksStore.categories.data.length) {
    booksStore.fetchCategories();
}

const validateForm = yup.object({
    title: yup.string().required().label("test"),
    category_id: yup.object().nullable().required(),
    quantity: yup.string().required(),
    year: yup.string(),
    price: yup.string(),
    image: yup.string(),
    // publisher_id: yup.string(),
    authors: yup.array<AuthorModel>(),
});

const imgSrc = ref<String|ArrayBuffer|null|undefined>("");
var onFile = (e: any) => {
    const files = e.target.files
    if (!files.length) return

    const reader = new FileReader()
    reader.readAsDataURL(files[0])
    reader.onload = (e) => {
        watchEffect(() => {
            imgSrc.value = e.target?.result;
        });
    }
}

const filteredAuthors = ref<Array<AuthorModel>>([]);
const filteredCategories = ref<Array<CategoryModel>>([]);

const selectedAuthors = ref<Array<string>>([]);
const selectedCategory = ref<CategoryModel>();

// watchEffect(() => {
//     filteredAuthors.value = authorsStore.authors;
// });
// watchEffect(() => {
//     filteredCategories.value = booksStore.categories.data;
// });
var searchAuthors = (event: any) => {
    watchEffect(() => {
        filteredAuthors.value = authorsStore.authors.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    });
}
var searchCategories = (event: any) => {
    watchEffect(() => {
        filteredCategories.value = booksStore.categories.data.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    });
}

var onSubmit = async (book: any) => {
    book.category_id = book.category_id?.id;
    book.authors = book.authors.map((x: any) => x.id);
    await booksStore.createBook(book);
}
</script>

<template>
    <GoBack go-back-text="Create Book" />

    <Form @submit="onSubmit" :validation-schema="validateForm" class="form-control">
        <div class="form-group image" as="image">
            <img :src="imgSrc?.toString()" v-if="imgSrc" />
            <div v-else class="overlay">
                <label for="image">Select a photo</label>
            </div>
            <input name="image" type="file" @change="onFile">
            <ErrorMessage name="image" />
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <Field name="title" />
            <ErrorMessage name="title" />
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <Field name="year" />
            <ErrorMessage name="year" />
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <Field name="quantity" />
            <ErrorMessage name="quantity" />
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <Field name="price" />
            <ErrorMessage name="price" />
        </div>
        <!-- <div class="form-group">
            <label for="price">Publisher</label>
            <AutoComplete name="publisher_id" v-model="selectedPublisher" :suggestions="filteredPublishers" @complete="searchPublishers($event)" optionLabel="name" />
            <ErrorMessage name="publisher_id" />
        </div> -->
        <div class="form-group">
            <Field name="authors" type="hidden" :value="selectedAuthors" v-model="selectedAuthors" />
            <label for="authors">Authors</label>
            <AutoComplete name="authors" v-model="selectedAuthors" :suggestions="filteredAuthors" @complete="searchAuthors($event)" optionLabel="name" :multiple="true" />
            <ErrorMessage name="authors" />
        </div>
        <div class="form-group">
            <Field name="category_id" type="hidden" :value="selectedCategory" v-model="selectedCategory" />
            <label for="category_id">Category</label>
            <AutoComplete name="category_id" v-model="selectedCategory" :suggestions="filteredCategories" @complete="searchCategories($event)" optionLabel="name" />
            <ErrorMessage name="category_id" />
        </div>

        <input value="Create" type="submit" class="btn w-100">
    </Form>
</template>

<style scoped>
.image {
    width: 120px;
    margin: 0 auto;
    height: 150px;
    margin-bottom: 20px;
}
.image input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
}
.image .overlay {
    width: 100%;
    height: 100%;
    border: 1px solid #D0D5DD;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.image img {
    border-radius: 12px;
    object-fit: cover;
}
</style>