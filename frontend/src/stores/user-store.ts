import { defineStore } from "pinia";
import axios from "axios"
import UserModel from "@/models/user/UserModel";
import SearchUserModel from "@/models/user/SearchUserModel";
import NotificationHelper from "@/helpers/NotificationHelper";
import type UserEditModel from "@/models/user/UserEditModel";
import type RoleModel from "@/models/user/RoleModel";

export const useUsersStore = defineStore('useUsersStore', {
    state: () => ({
        isLoading: false,

        users: {
            data: [] as UserModel[],
            searchModel: new SearchUserModel(),
            totalUsers: 0,
        },
        user: new UserModel(),
        profile: new UserModel(),
        roles: [] as RoleModel[],
    }),
    actions: {
        fetchSelectedUser(userId: String) {
            this.isLoading = true;
            axios.get("/users/" + userId )
            .then(result => {
                if(!result.data) return;

                this.user = result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchUsers() {
            this.isLoading = true;
            axios.post("/users/search", this.users.searchModel)
            .then(result => {
                if(!result.data) return;

                this.users.data = result.data.data;
                this.users.searchModel.pagination.total = result.data.total ?? 1;
                this.users.searchModel.pagination.last_page = result.data.last_page ?? 1;
                this.users.totalUsers = result.data.total;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async createUser(user: UserEditModel ) {
            this.isLoading = true;
            return axios.post("/users/add-user", user)
            .then(result => {
              NotificationHelper.NotifySuccess('User was created with scucces!')
              return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async updateUser(user: UserEditModel) {
            this.isLoading = true;
            return axios.post("/users/update-user", user)
            .then(result => {
                NotificationHelper.NotifySuccess('User was edited with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        async deleteUser(userId: Number) {
            this.isLoading = true;
            return axios.delete("/users/delete-user/" + userId)
            .then(result => {
                NotificationHelper.NotifySuccess('User was deleted with scucces!')
                return result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchRoles() {
            this.isLoading = true;
            axios.get("/users/roles")
            .then(result => {
                if(!result.data) return;

                this.roles = result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
        fetchProfile() {
            this.isLoading = true;
            axios.get("/users/user/profile")
            .then(result => {
                if(!result.data) return;

                this.profile = result.data;
            })
            .catch(error => console.error("Request error: " + error))
            .finally(() => this.isLoading = false);
        },
    }
})