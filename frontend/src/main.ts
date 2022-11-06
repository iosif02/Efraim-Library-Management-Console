import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "@/App.vue";
import router from "@/router";
import Notifications from '@kyvg/vue3-notification';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faHouseUser } from '@fortawesome/free-solid-svg-icons';
import { faUser } from '@fortawesome/free-solid-svg-icons';
import { faBook } from '@fortawesome/free-solid-svg-icons';

import "@/interceptors/axios"
import "@/assets/main.css";

library.add(faHouseUser);
library.add(faUser);
library.add(faBook);

const app = createApp(App);

app.use(createPinia());
app.use(router);
app.use(Notifications);

app.component('font-awesome-icon', FontAwesomeIcon)

app.mount("#app");
