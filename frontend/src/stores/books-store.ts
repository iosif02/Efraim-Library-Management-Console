import { defineStore } from "pinia";
import axios from "axios"
import HomepageViewModel from "@/models/book/HomepageViewModel";
import SearchBookModel from "@/models/book/SearchBookModel";
import BookModel from "@/models/book/BookModel";
import type DelayedBookModel from "@/models/book/DelayedBookModel";
import type BorrowBookModel from "@/models/book/BorrowBookModel";

export const useBooksStore = defineStore('useBooksStore', {
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
    bookDetails: new BookModel(),
	}),
  getters: {

  },
  actions: {
    fetchHomepage() {
      this.isLoading = true;
      axios.get("/books/homepage")
      .then(result => {
          if(!result.data) return;

          this.homepage.data.categories = result.data?.categories?.data;
          this.homepage.data.popularBooks = result.data?.popularBooks?.data;
          this.homepage.data.delayedBooks = result.data?.delayedBooks?.data;
          this.homepage.data.totalDelayedBooks = result.data?.delayedBooks?.total;
          this.homepage.isFetched = true;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    fetchPopularBooks() {
      this.isLoading = true;
      axios.post("/books/popular-books", this.popularBooks.searchModel)
      .then(result => {
          if(!result.data) return;

          this.popularBooks.data = result.data.data;
          this.popularBooks.searchModel.pagination.total = result.data.total ?? 1;
          this.popularBooks.searchModel.pagination.last_page = result.data.last_page ?? 1;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    fetchDelayedBooks() {
      this.isLoading = true;
      axios.post("/books/delayed-books", this.delayedBooks.searchModel)
      .then(result => {
          if(!result.data) return;

          this.delayedBooks.data = result.data.data;
          this.delayedBooks.searchModel.pagination.total = result.data.total ?? 1;
          this.delayedBooks.searchModel.pagination.last_page = result.data.last_page ?? 1;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    fetchBookDetails(bookId: String) {
      this.isLoading = true;
      axios.get("/books/" + bookId)
      .then(result => {
          if(!result.data) return;

          this.bookDetails = result.data;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    searchBooks() {
      this.isLoading = true;
      axios.post("/books/search", this.homepage.searchModel)
      .then(result => {
          if(!result.data) return;

          this.homepage.data.books = result.data.data;
          this.homepage.searchModel.pagination.total = result.data.total ?? 1;
          this.homepage.searchModel.pagination.last_page = result.data.last_page ?? 1;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    async createBook(book: BookModel) {
      this.isLoading = true;
      return axios.post("/books/add", book)
      .then(result => {
        return result.data;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    updateBook(book: BookModel) {
      this.isLoading = true;
      axios.post("/books/update", book)
      .then(result => {
        return result.data;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    returnBook(transactionId: number){
      this.isLoading = true;
      axios.post("/books/return/" + transactionId)
      .then(result => {
        return result.data;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    async borrowBook(borrowModel: BorrowBookModel) {
      this.isLoading = true;
      return axios.post("/books/borrow", borrowModel)
      .then(result => {
        return result.data;
      })
      .catch(error => console.error("Request error: " + error))
      .finally(() => this.isLoading = false);
    },
    popularBooksChangePage(page: number) {
      this.popularBooks.searchModel.pagination.page = page;
    },
    delayedBooksChangePage(page: number) {
      this.delayedBooks.searchModel.pagination.page = page;
    },
    booksHomeChangePage(page: number) {
      this.homepage.searchModel.pagination.page = page;
    }
  },
})