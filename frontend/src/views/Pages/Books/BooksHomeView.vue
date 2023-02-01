<script setup lang="ts">
import { booksStore } from '@/stores/booksStore';
import DelayedBooks from '@/components/books/DelayedBooks.vue';
import PopularBooks from '@/components/books/PopularBooks.vue';
import Categories from '@/components/books/Categories.vue';
import TitleSection from "@/components/global/TitleSection.vue";
import SearchBooksHomeView from './SearchBooksHomeView.vue';
import { watch } from 'vue';

const store = booksStore();
if(!store.homepage.isFetched){
  await store.fetchHomepage();
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
        <TitleSection :title="`Late (${store.homepage.data.DelayedBooks?.Total})`" :route-name="'delayedBooks'" />
        <DelayedBooks :books="store.homepage.data.DelayedBooks?.Books" />
      </div>

      <div class="popular-books">
        <TitleSection :title="'Popular Books'" :route-name="'popularBooks'" />
        <PopularBooks :books="store.homepage.data.PopularBooks" />
      </div>

      <div class="categories">
        <TitleSection :title="'Categories'" :route-name="'categories'" />
        <Categories :categories="store.homepage.data.Categories"/>
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
    margin-bottom: 20px;
}
</style>