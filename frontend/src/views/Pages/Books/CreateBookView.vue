<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { ref, watchEffect } from 'vue';
import { useBooksStore } from '@/stores/books-store';
import { useEntitiesStore } from '@/stores/entities-store';
import type AuthorModel from '@/models/entities/AuthorModel';
import type CategoryModel from '@/models/entities/CategoryModel';
import type PublisherModel from '@/models/entities/PublisherModel';
import router from '@/router';

const entitiesStore = useEntitiesStore();
const booksStore = useBooksStore();

if(!entitiesStore.entities.publishers.length) {
    entitiesStore.fetchEntities();
}

const validateForm = yup.object({
    image: yup.string().nullable(),
    title: yup.string().required(),
    year: yup.number().typeError('Years must be a number').required().positive(),
    quantity: yup.number().typeError('Quantity must be a number').required(),
    price: yup.number().typeError('Price must be a number').required(),
    publisher: yup.object().typeError('Must be one in the dropdown').required(),
    authors: yup.array<AuthorModel>().typeError('Must be one in the dropdown').required(),
    category: yup.object().typeError('Must be one in the dropdown').required(),
});

const imgSrc = ref<String|ArrayBuffer|null|undefined>("");
var onFile = (e: any) => {
    const files = e.target.files;
    if (!files.length) return;

    const reader = new FileReader();
    reader.readAsDataURL(files[0]);
    reader.onload = (e) => {
        watchEffect(() => {
            imgSrc.value = e.target?.result;
        });
    }
}

const filteredAuthors = ref<Array<AuthorModel>>([]);
const filteredCategories = ref<Array<CategoryModel>>([]);
const filteredPublishers = ref<Array<PublisherModel>>([]);

const selectedAuthors = ref<Array<AuthorModel>>([]);
const selectedCategory = ref<CategoryModel>();
const selectedPublisher = ref<PublisherModel>();

var searchAuthors = (event: any) => {
    watchEffect(() => {
        filteredAuthors.value = entitiesStore.entities.authors.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase())).filter(x => !selectedAuthors.value.some(x2 => x.id === x2.id));
    });
}
var searchCategories = (event: any) => {
    watchEffect(() => {
        filteredCategories.value = entitiesStore.entities.categories.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    });
}
var searchPublishers = (event: any) => {
    watchEffect(() => {
        filteredPublishers.value = entitiesStore.entities.publishers.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    });
}

var onSubmit = (book: any) => {
    book.image = imgSrc.value;
    book.category_id = book.category?.id;
    book.publisher_id = book.publisher?.id;
    book.authors = book.authors.map((x: AuthorModel) => x.id);
    booksStore.createBook(book).then(result => {
        if(result){
            if(booksStore.homepage.searchModel.title != "")
                booksStore.searchHomeBooks();
            router.back()
        }
    });
}

</script>

<template>
    
    <Loading v-if="booksStore.isLoading" />

    <GoBack go-back-text="Back" />

    <Form @submit="onSubmit" :validation-schema="validateForm" class="form-control">
        <div class="form-group image">
            <img :src="imgSrc?.toString()" v-if="imgSrc?.toString()" />
            <div v-else class="overlay">
                <label for="image">Select a photo</label>
            </div>
            <input name="select_image" type="file" @change="onFile">
            <ErrorMessage name="image" />
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <Field name="title" />
            <ErrorMessage name="title" />
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <Field name="year" type="number" pattern="[0-9]*" />
            <ErrorMessage name="year" />
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <Field name="quantity" type="number" pattern="[0-9]*" />
            <ErrorMessage name="quantity" />
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <Field name="price" type="number" pattern="[0-9]*" />
            <ErrorMessage name="price" />
        </div>
        <div class="form-group">
            <Field name="publisher" type="hidden" :value="selectedPublisher" v-model="selectedPublisher" />
            <label for="price">Publisher</label>
            <AutoComplete name="publisher" v-model="selectedPublisher" :suggestions="filteredPublishers" @complete="searchPublishers($event)" optionLabel="name" :dropdown="true" />
            <ErrorMessage name="publisher" />
        </div>
        <div class="form-group">
            <Field name="authors" type="hidden" :value="selectedAuthors" v-model="selectedAuthors" />
            <label for="authors">Authors</label>
            <AutoComplete name="authors" v-model="selectedAuthors" :suggestions="filteredAuthors" @complete="searchAuthors($event)" optionLabel="name" :dropdown="true" :multiple="true" />
            <ErrorMessage name="authors" />
        </div>
        <div class="form-group">
            <Field name="category" type="hidden" :value="selectedCategory" v-model="selectedCategory" />
            <label for="category">Category</label>
            <AutoComplete name="category" v-model="selectedCategory" :suggestions="filteredCategories" @complete="searchCategories($event)" :dropdown="true" optionLabel="name" />
            <ErrorMessage name="category" />
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
    max-width: 100%;
    max-height: 100%;
}
</style>