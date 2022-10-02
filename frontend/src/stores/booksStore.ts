import { defineStore } from "pinia";
import axios from "axios"
import { config } from "@/../env.d";

export const booksStore = defineStore('booksStore', {
  state: () => ({ 
		books: []
	}),
  getters: {
    getBooks: (state) => state.books,
  },
  actions: {
    async fetchBooks() {
			try {
				let books = await axios.get(config.apiUrl + "/books");
				if(books) {
					books = books
				}
			} catch(ex) {
				console.error("Request error: " + ex);
			}
    },
  },
})