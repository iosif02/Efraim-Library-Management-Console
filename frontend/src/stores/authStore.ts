import { defineStore } from "pinia";
import axios from "axios"
import { config } from "@/../env.d";
import type RegisterModel from "@/models/auth/RegisterModel";
import NotificationHelper from "@/helpers/NotificationHelper";

export const authStore = defineStore('authStore', {
  state: () => ({
		isAuthenticated: false,
		bearerToken: "",
		userDetails: ""
	}),
  getters: {
  },
  actions: {
    async register(user: RegisterModel) {
			try {
				let response = await axios.post(config.apiUrl + "/register", user);

				if(response?.data == 1) {
					NotificationHelper.NotifySuccess("The user was created. Please login!");
					return true;
				}

				return false;
			} catch(ex: any) {
				if(ex?.response?.data?.errors) {
					NotificationHelper.NotifyFormValidation(ex.response.data.errors);
				} else {
					console.error("Request error: " + ex);
					NotificationHelper.NotifyError("Error occurred. Please contact the administrator!");
				}
			}
    },
		async login(user: RegisterModel) {
			try {
				let response = await axios.post(config.apiUrl + "/login", user);

				if(response?.data?.token) {
					localStorage.setItem("bearerToken", response.data.token);
					localStorage.setItem("userDetails", JSON.stringify(response.data.user));

					return true;
				}

				return false;
			} catch(ex: any) {
				if(ex?.response?.data?.errors) {
					NotificationHelper.NotifyFormValidation(ex.response.data.errors);
				} else {
					console.error("Request error: " + ex);
					NotificationHelper.NotifyError("Error occurred. Please contact the administrator!");
				}
			}
    },
		loadUserDetailsFromStorage() {
			let userDetails = localStorage.getItem("userDetails");
			if(userDetails) {
				this.$state.userDetails = userDetails;
				this.$state.isAuthenticated = true;
			}

			return this.$state.isAuthenticated;
		}
  },
})