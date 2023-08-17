import Pagination from "@/models/global/PaginationModel";

export default class SearchBookModel {
	title: string = "";
    author: number = 0;
    category: number = 0;
    user: number = 0;
    searchAll: string = "";

    pagination: Pagination = new Pagination();
}