import { defineStore } from "pinia";
import axios from "axios"
import AuthorModel from "@/models/entities/AuthorModel";
import SearchAuthorModel from "@/models/entities/SearchAuthorModel";
import PublisherModel from "@/models/entities/PublisherModel";
import SearchPublisherModel from "@/models/entities/SearchPublisherModel";
import CategoryModel from "@/models/entities/CategoryModel";
import SearchCategoryModel from "@/models/entities/SearchCategoryModel";
import NotificationHelper from "@/helpers/NotificationHelper";

export const useEntitiesStore = defineStore('useEntitiesStore', {
    state: () => ({
        isLoading: false,

        authors: {
            data: [] as AuthorModel[],
            searchModel: new SearchAuthorModel(),
            totalAuthors: 0,
        },
        publishers: {
            data: [] as PublisherModel[],
            searchModel: new SearchPublisherModel(),
            totalPublishers: 0,
        },
        categories: {
            data: [] as CategoryModel[],
            searchModel: new SearchCategoryModel(),
            totalCategories: 0,
        },
        entities: {
            publishers: [] as PublisherModel[],
            authors: [] as AuthorModel[],
            categories: [] as CategoryModel[],
        },
        author: new AuthorModel(),
        publisher: new PublisherModel(),
        category: new CategoryModel(),
    }),
    getters: {

    },
    actions: {
        fetchSelectedAuthor(authorId: String) {
            this.isLoading = true;
            axios.get("/entities/authors/" + authorId )
            .then(result => {
                if(!result.data) return;

                this.author = result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchAuthors() {
            this.isLoading = true;
            axios.post("/entities/authors/search", this.authors.searchModel)
            .then(result => {
                if(!result.data) return;

                this.authors.data = result.data.data;
                this.authors.searchModel.pagination.total = result.data.total ?? 1;
                this.authors.searchModel.pagination.last_page = result.data.last_page ?? 1;
                this.authors.totalAuthors = result.data.total;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async createAuthor(author: AuthorModel) {
            this.isLoading = true;
            return axios.post("/entities/authors/add-author", author)
            .then(result => {
              NotificationHelper.NotifySuccess('Author was created with scucces!')
              return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async updateAuthor(author: AuthorModel) {
            this.isLoading = true;
            return axios.post("/entities/authors/update-author", author)
            .then(result => {
                NotificationHelper.NotifySuccess('Author was edited with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async deleteAuthor(authorId: Number) {
            this.isLoading = true;
            return axios.delete("/entities/authors/delete-author/" + authorId)
            .then(result => {
                NotificationHelper.NotifySuccess('Author was deleted with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchSelectedPublisher(publisherId: String) {
            this.isLoading = true;
            axios.get("/entities/publishers/" + publisherId )
            .then(result => {
                if(!result.data) return;

                this.publisher = result.data;
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
                this.publishers.totalPublishers = result.data.total;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
          },
        async createPublisher(publisher: PublisherModel) {
        this.isLoading = true;
        return axios.post("/entities/publishers/add-publisher", publisher)
        .then(result => {
            NotificationHelper.NotifySuccess('Publisher was created with scucces!')
            return result.data;
        })
        .catch(error => console.error("Request error: " + error))
        .finally(() => this.isLoading = false);
        },
        async updatePublisher(publisher: PublisherModel) {
            this.isLoading = true;
            return axios.post("/entities/publishers/update-publisher", publisher)
            .then(result => {
                NotificationHelper.NotifySuccess('Author was edited with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async deletePublisher(publisherId: Number) {
            this.isLoading = true;
            return axios.delete("/entities/publishers/delete-publisher/" + publisherId)
            .then(result => {
                NotificationHelper.NotifySuccess('Publisher was deleted with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchSelectedCategory(categoryId: String) {
            this.isLoading = true;
            axios.get("/entities/categories/" + categoryId )
            .then(result => {
                if(!result.data) return;

                this.category = result.data;
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
                this.categories.totalCategories = result.data.total;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async createCategory(category: CategoryModel) {
            this.isLoading = true;
            return axios.post("/entities/categories/add-category", category)
            .then(result => {
                NotificationHelper.NotifySuccess('Category was created with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async updateCategory(category: CategoryModel) {
            this.isLoading = true;
            return axios.post("/entities/categories/update-category", category)
            .then(result => {
                NotificationHelper.NotifySuccess('Author was edited with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async deleteCategory(categoryId: Number) {
            this.isLoading = true;
            return axios.delete("/entities/categories/delete-category/" + categoryId)
            .then(result => {
                NotificationHelper.NotifySuccess('Category was deleted with scucces!')
                return result.data;
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