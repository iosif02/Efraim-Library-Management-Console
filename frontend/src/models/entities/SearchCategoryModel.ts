import Pagination from "@/models/global/PaginationModel";

export default class SearchPublisherModel {
	name: string = "";
    getAll: boolean = false;

    pagination: Pagination = new Pagination();
}