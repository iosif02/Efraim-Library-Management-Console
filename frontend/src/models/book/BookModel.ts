import CategoryModel from "@/models/book/CategoryModel";
import type AuthorModel from "@/models/author/AuthorModel";

export default class BookModel {
	title: string = "";
	year: number = 0;
    price: string = "";
    image: string = "";
    quantity: number = 0;
    is_recommended: boolean = false;
    order: number = 0;

    category: CategoryModel = new CategoryModel();
    authors: AuthorModel[] = [];
}