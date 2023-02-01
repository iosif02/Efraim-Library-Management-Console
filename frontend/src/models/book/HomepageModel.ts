import type Categories from "@/models/book/Category";
import type PopularBook from "@/models/book/PopularBook";
import DelayedBooks from "@/models/book/DelayedBooks";

export default class HomepageModel {
	Categories: Categories[] = [];
	DelayedBooks: DelayedBooks = new DelayedBooks();
    PopularBooks: PopularBook[] = []
}