import { defineStore } from "pinia";
import axios from "axios"
import HomepageModel from "@/models/book/HomepageModel";
import DelayedBooksModel from "@/models/book/DelayedBooks";
import Pagination from "@/models/global/Pagination";

export const booksStore = defineStore('booksStore', {
  state: () => ({ 
		homepage: new HomepageModel(),
    homepageFetched: false,
    popularBooks: [],
    delayedBooks: new DelayedBooksModel(),
    categories: [],

    delayedBooksPagination: new Pagination(),
    popularBooksPagination: new Pagination(),
    categoriesPagination: new Pagination()
	}),
  getters: {

  },
  actions: {
    async fetchHomepage() {
      try {
        let books = await axios.get("/books/homepage");
        if(books) {
          this.homepage = books.data;
          this.homepageFetched = true;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchPopularBooks() {
      try {
        let books = await axios.get("/books/popular-books");
        if(books) {
          this.popularBooks = books.data;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchDelayedBooks() {
      try {
        let books = await axios.get("/books/delayed-books/?page=" + this.delayedBooksPagination.CurrentPage);
        if(books) {
          this.delayedBooks = books.data;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchCategories() {
      try {
        let books = await axios.get("/books/categories");
        if(books) {
          this.categories = books.data;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    }
  },
})