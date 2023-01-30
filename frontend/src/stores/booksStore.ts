import { defineStore } from "pinia";
import axios from "axios"
import HomepageModel from "@/models/book/HomepageModel";

export const booksStore = defineStore('booksStore', {
  state: () => ({ 
		homepage: new HomepageModel()
	}),
  getters: {
    getDelayedBooks: (state) => state.homepage.DelayedBooks,
    getPopularBooks: (state) => state.homepage.PopularBooks,
    getCategories: (state) => state.homepage.Categories,
  },
  actions: {
    async fetchBooks() {
      try {
        let books = await axios.get("/book");
        if(books) {
          this.homepage = books.data;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    }
  },
})