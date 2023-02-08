import { defineStore } from "pinia";
import axios from "axios"
import type AuthorModel from "@/models/author/AuthorModel";
import SearchAuthorModel from "@/models/author/SearchAuthorModel";

export const useAuthorsStore = defineStore('useAuthorsStore', {
    state: () => ({
        authors: [] as AuthorModel[],
        searchModel: new SearchAuthorModel()
    }),
    getters: {

    },
    actions: {
        async fetchAuthors() {
            try {
                let authors = await axios.post("/authors/search", this.searchModel);
                if(authors?.data) {
                    this.authors = authors.data.data;
                    this.searchModel.pagination.total = authors.data.total ?? 1;
                    this.searchModel.pagination.last_page = authors.data.last_page ?? 1;
                }
            } catch(ex) {
                console.error("Request error: " + ex);
            }
          },
    }
})