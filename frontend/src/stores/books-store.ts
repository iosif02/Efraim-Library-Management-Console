import { defineStore } from "pinia";
import axios from "axios"
import HomepageViewModel from "@/models/book/HomepageViewModel";
import SearchBookModel from "@/models/book/SearchBookModel";
import type CategoryModel from "@/models/book/CategoryModel";
import type BookModel from "@/models/book/BookModel";
import type DelayedBookModel from "@/models/book/DelayedBookModel";

export const booksStore = defineStore('booksStore', {
  state: () => ({
    isLoading: false,

		homepage: {
      searchModel: new SearchBookModel(),
      data: new HomepageViewModel(),
      isFetched: false
    },
    popularBooks: {
      searchModel: new SearchBookModel(),
      data: [] as BookModel[]
    },
    delayedBooks: {
      searchModel: new SearchBookModel(),
      data: [] as DelayedBookModel[]
    },
    categories: {
      searchModel: new SearchBookModel(),
      data: [] as CategoryModel[]
    },
    books: {
      searchModel: new SearchBookModel(),
      data: [] as BookModel[]
    }
	}),
  getters: {

  },
  actions: {
    async fetchHomepage() {
      try {
        this.isLoading = true;
        let books = await axios.get("/books/homepage");
        if(books?.data) {
          this.homepage.data.categories = books.data?.categories?.data;
          this.homepage.data.popularBooks = books.data?.popularBooks?.data;
          this.homepage.data.delayedBooks = books.data?.delayedBooks?.data;
          this.homepage.data.totalDelayedBooks = books.data?.delayedBooks?.total;
          this.homepage.isFetched = true;
          this.isLoading = false;
        }
      } catch(ex) {
        this.isLoading = false;
        console.error("Request error: " + ex);
      }
    },
    async fetchPopularBooks() {
      try {
        let books = await axios.post("/books/popular-books", this.popularBooks.searchModel);
        if(books?.data) {
          this.popularBooks.data = books.data.data;
          this.popularBooks.searchModel.pagination.total = books.data.total ?? 1;
          this.popularBooks.searchModel.pagination.last_page = books.data.last_page ?? 1;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchDelayedBooks() {
      try {
        let books = await axios.post("/books/delayed-books", this.delayedBooks.searchModel);
        if(books?.data) {
          this.delayedBooks.data = books.data.data;
          this.delayedBooks.searchModel.pagination.total = books.data.total ?? 1;
          this.delayedBooks.searchModel.pagination.last_page = books.data.last_page ?? 1;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async fetchCategories() {
      try {
        let books = await axios.post("/books/categories", this.categories.searchModel);
        if(books?.data) {
          this.categories.data = books.data.data;
          this.categories.searchModel.pagination.total = books.data.total ?? 1;
          this.categories.searchModel.pagination.last_page = books.data.last_page ?? 1;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async searchBooks() {
      try {
        let books = await axios.post("/books/search?page=" + this.homepage.searchModel.pagination.page, this.homepage.searchModel);
        if(books?.data) {
          this.homepage.data.books = books.data.data;
          this.homepage.searchModel.pagination.total = books.data.total ?? 1;
          this.homepage.searchModel.pagination.last_page = books.data.last_page ?? 1;
        }
      } catch(ex) {
        console.error("Request error: " + ex);
      }
    },
    async popularBooksChangePage(page: number) {
      this.popularBooks.searchModel.pagination.page = page;
      this.fetchPopularBooks();
    },
    async delayedBooksChangePage(page: number) {
      this.delayedBooks.searchModel.pagination.page = page;
      this.fetchDelayedBooks();
    },
    async categoriesChangePage(page: number) {
      this.categories.searchModel.pagination.page = page;
      this.fetchCategories();
    },
    async booksHomeChangePage(page: number) {
      this.homepage.searchModel.pagination.page = page;
      this.searchBooks();
    }
  },
})