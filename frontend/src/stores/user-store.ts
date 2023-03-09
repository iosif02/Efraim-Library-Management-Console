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
        fetchUsers() {
            this.isLoading = true;
            axios.post("/user/users", this.users.searchModel)
            .then(result => {
                if(!result.data) return;

                this.users.data = result.data.data;
                this.users.searchModel.pagination.total = result.data.total ?? 1;
                this.users.searchModel.pagination.last_page = result.data.last_page ?? 1;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        userChangePage(page: number) {
            this.users.searchModel.pagination.page = page;
        },
    }
})