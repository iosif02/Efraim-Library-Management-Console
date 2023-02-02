import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "@/App.vue";
import router from "@/router";
import Notifications from '@kyvg/vue3-notification';

import "@/interceptors/axios"
import "@/assets/main.css";

import GoBackVue from "./components/global/GoBack.vue";
import Loading from '@/components/global/Loading.vue';
import SearchBar from '@/components/global/SearchBar.vue';

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.use(Notifications);

app.component('GoBack', GoBackVue);
app.component('Loading', Loading);
app.component('SearchBar', SearchBar);

app.mount("#app");
