import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "@/App.vue";
import router from "@/router";
import Notifications from '@kyvg/vue3-notification';
import PrimeVue from 'primevue/config';
import AutoComplete from 'primevue/autocomplete';

import "@/interceptors/axios"
import "@/assets/main.css";
import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";

import GoBackVue from "./components/global/GoBackComponent.vue";
import Loading from '@/components/global/LoadingComponent.vue';
import SearchBar from '@/components/global/SearchBarComponent.vue';

const app = createApp(App);

app.use(PrimeVue);
app.use(createPinia());
app.use(router);
app.use(Notifications);

app.component('GoBack', GoBackVue);
app.component('Loading', Loading);
app.component('SearchBar', SearchBar);

app.component('AutoComplete', AutoComplete);

app.mount("#app");
