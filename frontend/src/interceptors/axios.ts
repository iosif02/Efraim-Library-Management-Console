import { config } from "@/../env.d";
import axios from "axios";

const token = localStorage.getItem('bearerToken');
axios.interceptors.request.use(function (axiosConfig) {
	axiosConfig.baseURL = config.apiUrl;
	axiosConfig.headers = {
		Authorization: `Bearer ${token}`,
	}
	return axiosConfig;
	}, function (error) {
	return Promise.reject(error);
});