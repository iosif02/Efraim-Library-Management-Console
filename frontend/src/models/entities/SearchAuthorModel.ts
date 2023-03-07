import Pagination from "@/models/global/PaginationModel";

export default class SearchAuthorModel {
	name: string = "";
    getAll: boolean = false;

    pagination: Pagination = new Pagination();
}