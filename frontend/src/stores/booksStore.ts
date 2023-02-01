import { defineStore } from "pinia";
import axios from "axios"
import HomepageModel from "@/models/book/HomepageModel";
import DelayedBooksModel from "@/models/book/DelayedBooks";
import Pagination from "@/models/global/Pagination";
import SearchBookModel from "@/models/book/SearchBook";

export const booksStore = defineStore('booksStore', {
  state: () => ({
    isLoading: false,

		homepage: new HomepageModel(),
    homepageFetched: false,

    popularBooks: {
      data: [],
      pagination: new Pagination(),
      searchModel: new SearchBookModel()
    },
    delayedBooks: {
      data: new DelayedBooksModel(),
      pagination: new Pagination(),
      searchModel: new SearchBookModel()
    },
    categories: {
      data: [],
      pagination: new Pagination(),
      searchModel: new SearchBookModel()
    }
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
        let books = await axios.get("/books/popular-books/?page=" + this.popularBooks.pagination.CurrentPage);
        if(books) {
          this.popularBooks.data = books.data;
          this.popularBooks.pagination.LastPage = books.data.LastPage ?? 1;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchDelayedBooks() {
      try {
        let books = await axios.get("/books/delayed-books/?page=" + this.delayedBooks.pagination.CurrentPage);
        if(books) {
          this.delayedBooks.data = books.data;
          this.delayedBooks.pagination.LastPage = books.data.LastPage ?? 1;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchCategories() {
      try {
        let books = await axios.get("/books/categories/?page=" + this.categories.pagination.CurrentPage);
        if(books) {
          this.categories.data = books.data;
          this.categories.pagination.LastPage = books.data.LastPage ?? 1;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async popularBooksChangePage(page: number) {
      this.popularBooks.pagination.CurrentPage = page;
      this.fetchPopularBooks();
    },
    async delayedBooksChangePage(page: number) {
      this.delayedBooks.pagination.CurrentPage = page;
      this.fetchDelayedBooks();
    },
    async categoriesChangePage(page: number) {
      this.categories.pagination.CurrentPage = page;
      this.fetchCategories();
    }
  },
})