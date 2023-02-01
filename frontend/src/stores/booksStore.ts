import { defineStore } from "pinia";
import axios from "axios"
import HomepageModel from "@/models/book/HomepageModel";
import DelayedBooksModel from "@/models/book/DelayedBooks";
import Pagination from "@/models/global/Pagination";
import SearchBookModel from "@/models/book/SearchBook";

export const booksStore = defineStore('booksStore', {
  state: () => ({
    isLoading: false,

		homepage: {
      data: new HomepageModel(),
      isFetched: false,
      books: [],
      pagination: new Pagination(),
      searchModel: new SearchBookModel(),
      total: 0
    },
    popularBooks: {
      data: [],
      pagination: new Pagination(),
      searchModel: new SearchBookModel()
    },
    delayedBooks: {
      // data: new DelayedBooksModel(),
      data: [],
      total: 0,
      pagination: new Pagination(),
      searchModel: new SearchBookModel()
    },
    categories: {
      data: [],
      pagination: new Pagination(),
      searchModel: new SearchBookModel()
    },
    books: {
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
          this.homepage.data = books.data;
          this.homepage.isFetched = true;
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
          this.delayedBooks.data = books.data.Books;
          this.delayedBooks.total = books.data.Total;
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
    async searchBooks() {
      try {
        let books = await axios.post("/books/search?page=" + this.homepage.pagination.CurrentPage, this.homepage.searchModel);
        if(books?.data) {
          this.homepage.books = books.data.data;
          this.homepage.pagination.LastPage = books.data.last_page;
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
    },
    async booksHomeChangePage(page: number) {
      this.homepage.pagination.CurrentPage = page;
      this.searchBooks();
    }
  },
})