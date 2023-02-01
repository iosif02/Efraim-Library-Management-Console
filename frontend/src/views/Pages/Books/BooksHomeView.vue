<script setup lang="ts">
import { booksStore } from '@/stores/booksStore';
import DelayedBooks from '@/components/books/DelayedBooks.vue';
import PopularBooks from '@/components/books/PopularBooks.vue';
import Categories from '@/components/books/Categories.vue';
import TitleSection from "@/components/global/TitleSection.vue";

const store = booksStore();
if(!store.homepageFetched){
  await store.fetchHomepage();
}

</script>

<template>
	<div class="homepage">
    <SearchBar />

    <div class="delayed-books">
      <TitleSection :title="`Late (${store.homepage.DelayedBooks?.Total})`" :route-name="'delayedBooks'" />
      <DelayedBooks :books="store.homepage.DelayedBooks?.Books" />
    </div>

    <div class="popular-books">
      <TitleSection :title="'Popular Books'" :route-name="'popularBooks'" />
      <PopularBooks :books="store.homepage.PopularBooks" />
    </div>

    <div class="categories">
      <TitleSection :title="'Categories'" :route-name="'categories'" />
      <Categories :categories="store.homepage.Categories"/>
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