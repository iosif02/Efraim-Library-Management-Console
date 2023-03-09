import { defineStore } from "pinia";
import axios from "axios"
import type UserModel from "@/models/user/UserModel";
import SearchUserModel from "@/models/user/SearchUserModel";

export const useUsersStore = defineStore('useUsersStore', {
    state: () => ({
        isLoading: false,

        users: {
            data: [] as UserModel[],
            searchModel: new SearchUserModel()
        },
    }),
    actions: {
        async fetchUsers() {
            try {
                this.isLoading = true;
                let users = await axios.post("/user/users", this.users.searchModel);
                if(users?.data) {
                    this.users.data = users.data.data;
                    this.users.searchModel.pagination.total = users.data.total ?? 1;
                    this.users.searchModel.pagination.last_page = users.data.last_page ?? 1;
                    this.isLoading = false;
                }
            } catch(ex) {
                this.isLoading = false;
                console.error("Request error: " + ex);
            }
        },
        async userChangePage(page: number) {
            this.users.searchModel.pagination.page = page;
        },
    }
})