import { defineStore } from "pinia";
import axios from "axios"
import HomepageModel from "@/models/book/HomepageModel";
import DelayedBooksModel from "@/models/book/DelayedBooks";
import Pagination from "@/models/global/Pagination";

export const booksStore = defineStore('booksStore', {
  state: () => ({
    isLoading: false,

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
        this.isLoading = true;
        let books = await axios.get("/books/homepage");
        if(books) {
          this.homepage = books.data;
          this.homepageFetched = true;
          this.isLoading = false;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchPopularBooks() {
      try {
        this.isLoading = true;
        let books = await axios.get("/books/popular-books/?page=" + this.popularBooksPagination.CurrentPage);
        if(books) {
          this.popularBooks = books.data;
          this.isLoading = false;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchDelayedBooks() {
      try {
        this.isLoading = true;
        let books = await axios.get("/books/delayed-books/?page=" + this.delayedBooksPagination.CurrentPage);
        if(books) {
          this.delayedBooks = books.data;
          this.isLoading = false;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchCategories() {
      try {
        this.isLoading = true;
        let books = await axios.get("/books/categories/?page=" + this.categoriesPagination.CurrentPage);
        if(books) {
          this.categories = books.data;
          this.isLoading = false;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async popularBooksChangePage(page: number) {
      this.popularBooksPagination.CurrentPage = page;
      this.fetchPopularBooks();
    },
    async delayedBooksChangePage(page: number) {
      this.delayedBooksPagination.CurrentPage = page;
      this.fetchDelayedBooks();
    },
    async categoriesChangePage(page: number) {
      this.categoriesPagination.CurrentPage = page;
      this.fetchCategories();
    }
  },
})