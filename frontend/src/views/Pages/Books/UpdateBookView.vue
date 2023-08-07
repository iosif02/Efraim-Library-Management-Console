<script setup lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { ref } from 'vue';
import { useBooksStore } from '@/stores/books-store';
import { useEntitiesStore } from '@/stores/entities-store';
import type AuthorModel from '@/models/entities/AuthorModel';
import type CategoryModel from '@/models/entities/CategoryModel';
import type PublisherModel from '@/models/entities/PublisherModel';
import router from '@/router';

const props = defineProps({
  id: String,
})

if(!props.id || props.id == '0' || !parseInt(props.id)){
  router.back();
}

const entitiesStore = useEntitiesStore();
const booksStore = useBooksStore();

booksStore.fetchBookDetails(props.id ?? "");

if(!entitiesStore.entities.publishers.length) {
    entitiesStore.fetchEntities();
}

const validateForm = yup.object({
    image: yup.string().nullable(),
    title: yup.string().required(),
    year: yup.number().typeError('Quantity must be a number').required(),
    quantity: yup.number().typeError('Quantity must be a number').required(),
    price: yup.number().typeError('Quantity must be a number').required(),
    publisher: yup.object().typeError('must be one in the dropdown').required(),
    authors: yup.array<AuthorModel>().typeError('must be one in the dropdown').required(),
    category: yup.object().typeError('must be one in the dropdown').required(),
});

const imgSrc = ref<String|ArrayBuffer|null|undefined>("");
var onFile = (e: any) => {
    const files = e.target.files;
    if (!files.length) return;

    const reader = new FileReader();
    reader.readAsDataURL(files[0]);
    reader.onload = (e) => {
        imgSrc.value = e.target?.result;
    }
}

const filteredAuthors = ref<Array<AuthorModel>>([]);
const filteredCategories = ref<Array<CategoryModel>>([]);
const filteredPublishers = ref<Array<PublisherModel>>([]);

const selectedAuthors = ref<Array<AuthorModel>>([]);
const selectedCategory = ref<CategoryModel>();
const selectedPublisher = ref<PublisherModel>();

var searchAuthors = (event: any) => {
    if(event?.query?.length > 2) {
        filteredAuthors.value = entitiesStore.entities.authors.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase())).filter(x => !selectedAuthors.value.some(x2 => x.id === x2.id));
    }
}
var searchCategories = (event: any) => {
    if(event?.query?.length > 2) {
        filteredCategories.value = entitiesStore.entities.categories.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    }
}
var searchPublishers = (event: any) => {
    if(event?.query?.length > 2) {
        filteredPublishers.value = entitiesStore.entities.publishers.filter(x => x.name.toLowerCase().includes(event.query.toLowerCase()));
    }
}

var onSubmit = (book: any) => {
    imgSrc.value ? book.image = imgSrc.value : delete book.image;
    book.category_id = book.category?.id;
    book.publisher_id = book.publisher?.id;
    book.authors = book.authors.map((x: AuthorModel) => x.id);
    book.bookId = props.id
    booksStore.updateBook(book)
    .then(result => {
        if(result){
            if(booksStore.homepage.searchModel.title != "")
            booksStore.searchHomeBooks();
            router.back();
        }
    });
}

let focusedElement: any = ref(null)

var blurInput = (e: any) => {
    if(focusedElement) focusedElement?.target?.focus();
    focusedElement.value = null;
}

function onFocusElement(e: any) {
    focusedElement = e;
}

</script>

<template>
    
    <Loading v-if="booksStore.isLoading" />

    <GoBack go-back-text="Back" />

    <Form @submit="onSubmit" :validation-schema="validateForm" class="form-control" :initial-values="booksStore.bookDetails" ref="myForm">
        <div class="form-group image">
            <img :src="imgSrc?.toString() || booksStore.bookDetails.image || '/img/book.jpg'" v-if="imgSrc?.toString() || booksStore.bookDetails.image " />
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
            <AutoComplete 
                name="publisher" v-model="selectedPublisher" :suggestions="filteredPublishers" @complete="searchPublishers($event)" optionLabel="name" :dropdown="true" 
                dropdownMode="current" scroll-height="150px" :min-length="3" loadingIcon="none" placeholder="Introduceti cel putin 3 caractere" @focus="onFocusElement" @item-select="blurInput"
            />
            <ErrorMessage name="publisher" />
        </div>
        <div class="form-group">
            <Field name="authors" type="hidden" :value="selectedAuthors" v-model="selectedAuthors" />
            <label for="authors">Authors</label>
            <AutoComplete 
                name="authors" v-model="selectedAuthors" :suggestions="filteredAuthors" @complete="searchAuthors($event)" optionLabel="name" :dropdown="true" :multiple="true"
                dropdownMode="current" scroll-height="150px" :min-length="3" loadingIcon="none" placeholder="Introduceti cel putin 3 caractere" @focus="onFocusElement" @item-select="blurInput"
            />
            <ErrorMessage name="authors" />
        </div>
        <div class="form-group">
            <Field name="category" type="hidden" :value="selectedCategory" v-model="selectedCategory" />
            <label for="category">Category</label>
            <AutoComplete 
                name="category" v-model="selectedCategory" :suggestions="filteredCategories" @complete="searchCategories($event)" optionLabel="name" :dropdown="true" 
                dropdownMode="current" scroll-height="150px" :min-length="3" loadingIcon="none" placeholder="Introduceti cel putin 3 caractere" @focus="onFocusElement" @item-select="blurInput"
            />
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
    width: 100%;
    height: 100%;
}
</style>