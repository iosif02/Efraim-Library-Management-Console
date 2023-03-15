import Pagination from "@/models/global/PaginationModel";

export default class SearchBookModel {
	title: string = "";
    author: string = "";
    category: number = 0;

    pagination: Pagination = new Pagination();
}