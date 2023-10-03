import { defineStore } from "pinia";
import axios from "axios"
import { config } from "@/../env.d";
import type RegisterModel from "@/models/auth/RegisterModel";
import NotificationHelper from "@/helpers/NotificationHelper";
import type LoginModel from "@/models/auth/LoginModel";
import UserModel from "@/models/user/UserModel";

export const authStore = defineStore('authStore', {
  	state: () => ({
		isAuthenticated: false,
		bearerToken: "",
		userDetails: new UserModel()
	}),
	getters: {
	},
  	actions: {
		async register(user: RegisterModel) {
			try {
				let response = await axios.post(config.apiUrl + "/register", user);

				if(response?.data) {
					NotificationHelper.NotifySuccess("The user was created. Please login!");
					return true;
				}
				
				return false;
			} catch(ex: any) {
				console.error("Request error: " + ex);
			}
		},
		async login(user: LoginModel) {
			try {
				const csrfToken = await axios.get(config.appUrl + "/sanctum/csrf-cookie");
				let response = await axios.post(config.apiUrl + "/login", user);

				if(response?.data?.token) {
					localStorage.setItem("bearerToken", response.data.token);
					localStorage.setItem("userDetails", JSON.stringify(response.data.user));

					return true;
				}

				return false;
			} catch(ex: any) {
				console.error("Request error: " + ex);
			}
		},
		loadUserDetailsFromStorage() {
			let userDetails = localStorage.getItem("userDetails");
			if(userDetails) {
				this.userDetails = JSON.parse(userDetails);
				this.isAuthenticated = true;
			}

			return this.isAuthenticated;
		},
		async logout() {
			try {
				await axios.post(config.apiUrl + "/logout");
				this.removeUserDetailsFromStorage();
				return true;
			} catch(ex) {
				console.error("Request error: " + ex);
			}
		},
		removeUserDetailsFromStorage() {
			localStorage.removeItem('bearerToken');
			localStorage.removeItem('userDetails');
			this.userDetails = new UserModel();
			this.isAuthenticated = false;
			this.bearerToken = "";
		}
  	},
})