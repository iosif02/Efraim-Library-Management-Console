import Pagination from "@/models/global/PaginationModel";

export default class SearchBookModel {
	title: string = "";
    author: string = "";
    getAll: boolean = false;

    pagination: Pagination = new Pagination();
}