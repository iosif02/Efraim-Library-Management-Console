<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { ref, watchEffect } from 'vue';
import { useBooksStore } from '@/stores/books-store';
import { useEntitiesStore } from '@/stores/entities-store';
import type AuthorModel from '@/models/entities/AuthorModel';
import type CategoryModel from '@/models/book/CategoryModel';
import type PublisherModel from '@/models/entities/PublisherModel';
import { watch } from 'vue';
import router from '@/router';

const props = defineProps({
  id: String,
})

const entitiesStore = useEntitiesStore();
const booksStore = useBooksStore();

if(!entitiesStore.authors.data.length) {
    entitiesStore.fetchAuthors();
}
if(!booksStore.categories.data.length) {
    booksStore.fetchCategories();
}
if(!entitiesStore.publishers.data.length) {
    entitiesStore.fetchPublishers();
}

const validateForm = yup.object({
    title: yup.string().required(),
    category: yup.object().nullable().required(),
    quantity: yup.string().required(),
    year: yup.string(),
    price: yup.string(),
    image: yup.string(),
    publisher: yup.object(),
    authors: yup.array<AuthorModel>(),
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
        filteredAuthors.value = entitiesStore.authors.data.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    });
}
var searchCategories = (event: any) => {
    watchEffect(() => {
        filteredCategories.value = booksStore.categories.data.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    });
}
var searchPublishers = (event: any) => {
    watchEffect(() => {
        filteredPublishers.value = entitiesStore.publishers.data.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    });
}

var onSubmit = (book: any) => {
    imgSrc.value ? book.image = imgSrc.value : delete book.image;
    book.category_id = book.category?.id;
    book.publisher_id = book.publisher?.id;
    book.authors = book.authors.map((x: any) =>{
        if(x.pivot)
            return x.pivot.author_id

        return x.id
    });
    book.bookId = props.id
    console.log(book)
    booksStore.updateBook(book);
}

if(!props.id || props.id == '0' || !parseInt(props.id)){
  router.back();
}

// if(!booksStore.bookDetails.id) {
    booksStore.fetchBookDetails(props.id ?? "");
// }

// watch(() => props.id, () => {
//     booksStore.fetchBookDetails(props.id ?? "");
// });

</script>

<template>
    
    <Loading v-if="booksStore.isLoading" />

    <GoBack go-back-text="Back" />

    <Form @submit="onSubmit" :validation-schema="validateForm" class="form-control" :initial-values="booksStore.bookDetails" ref="myForm">
        <div class="form-group image">
            <img :src="imgSrc?.toString() || booksStore.bookDetails.image" v-if="imgSrc?.toString() || booksStore.bookDetails.image " />
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
        
        <input value="Edit" type="submit" class="btn w-100">

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