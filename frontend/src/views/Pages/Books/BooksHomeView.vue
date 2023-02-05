<script setup lang="ts">
import { booksStore } from '@/stores/books-store';
import DelayedBooks from '@/components/books/DelayedBooksComponent.vue';
import PopularBooks from '@/components/books/PopularBooksComponent.vue';
import Categories from '@/components/books/CategoriesComponent.vue';
import TitleSection from "@/components/global/TitleSectionComponent.vue";
import SearchBooksHomeView from './SearchBooksHomeView.vue';
import { watch } from 'vue';

const store = booksStore();
if(!store.homepage.isFetched){
  store.fetchHomepage();
}

watch(() => store.homepage.searchModel, async () => {
  await store.searchBooks();
}, { deep: true });
</script>

<template>
	<div class="homepage">
    <Loading v-if="store.isLoading" />

    <SearchBar
        :defaultValue="store.homepage.searchModel.title"
        @keyup="(event: any) => store.homepage.searchModel.title = event?.target?.value"
    />

    <div v-if="!store.homepage.searchModel.title">
      <div class="delayed-books">
        <TitleSection :title="`Late (${store.homepage.data.totalDelayedBooks})`" :route-name="'delayedBooks'" />
        <DelayedBooks :books="store.homepage.data.delayedBooks" />
      </div>

      <div class="popular-books">
        <TitleSection :title="'Popular Books'" :route-name="'popularBooks'" />
        <PopularBooks :books="store.homepage.data.popularBooks" />
      </div>

      <div class="categories">
        <TitleSection :title="'Categories'" :route-name="'categories'" />
        <Categories :categories="store.homepage.data.categories"/>
      </div>
    </div>
    <div v-else>
      <SearchBooksHomeView />
    </div>

	</div>
</template>

<style scoped>
.spacer {
  margin-bottom: .8rem;
}
.delayed-books, .popular-books {
    margin-bottom: 30px;
}
</style>