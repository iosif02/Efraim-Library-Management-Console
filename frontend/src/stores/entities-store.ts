import { defineStore } from "pinia";
import axios from "axios"
import type AuthorModel from "@/models/entities/AuthorModel";
import SearchAuthorModel from "@/models/entities/SearchAuthorModel";
import type PublisherModel from "@/models/entities/PublisherModel";
import SearchPublisherModel from "@/models/entities/SearchPublisherModel";
import type CategoryModel from "@/models/entities/CategoryModel";
import SearchCategoryModel from "@/models/entities/SearchCategoryModel";

export const useEntitiesStore = defineStore('useEntitiesStore', {
    state: () => ({
        isLoading: false,

        authors: {
            data: [] as AuthorModel[],
            searchModel: new SearchAuthorModel()
        },
        publishers: {
            data: [] as PublisherModel[],
            searchModel: new SearchPublisherModel()
        },
        categories: {
            data: [] as CategoryModel[],
            searchModel: new SearchCategoryModel(),
        },
        entities: {
            publishers: [] as PublisherModel[],
            authors: [] as AuthorModel[],
            categories: [] as CategoryModel[],
        }
    }),
    getters: {

    },
    actions: {
        fetchAuthors() {
            this.isLoading = true;
            axios.post("/entities/authors/search", this.authors.searchModel)
            .then(result => {
                if(!result.data) return;

                this.authors.data = result.data.data;
                this.authors.searchModel.pagination.total = result.data.total ?? 1;
                this.authors.searchModel.pagination.last_page = result.data.last_page ?? 1;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchPublishers() {
            this.isLoading = true;
            axios.post("/entities/publishers/search", this.publishers.searchModel)
            .then(result => {
                if(!result.data) return;

                this.publishers.data = result.data.data;
                this.publishers.searchModel.pagination.total = result.data.total ?? 1;
                this.publishers.searchModel.pagination.last_page = result.data.last_page ?? 1;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
          },
        fetchCategories() {
            this.isLoading = true;
            axios.post("/entities/categories/search", this.categories.searchModel)
            .then(result => {
                if(!result.data) return;

                this.categories.data = result.data.data;
                this.categories.searchModel.pagination.total = result.data.total ?? 1;
                this.categories.searchModel.pagination.last_page = result.data.last_page ?? 1;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchEntities() {
            this.isLoading = true;
            axios.get("/entities")
            .then(result => {
                if(!result.data) return;

                this.entities.publishers = result.data?.publishers;
                this.entities.authors = result.data?.authors;
                this.entities.categories = result.data?.categories;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
    }
})