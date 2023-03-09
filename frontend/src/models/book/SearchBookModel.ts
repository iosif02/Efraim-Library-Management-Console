import Pagination from "@/models/global/PaginationModel";

export default class SearchBookModel {
	title: string = "";
    author: string = "";

    pagination: Pagination = new Pagination();
}