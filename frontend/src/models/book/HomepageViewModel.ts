import type CategoryModel from "@/models/entities/CategoryModel";
import type DelayedBookModel from "@/models/book/DelayedBookModel";
import type BookModel from "@/models/book/BookModel";

export default class HomepageViewModel {
	categories: CategoryModel[] = [];
	delayedBooks: DelayedBookModel[] = [];
    popularBooks: BookModel[] = [];
	books: BookModel[] = [];

	totalDelayedBooks: number = 0;
}