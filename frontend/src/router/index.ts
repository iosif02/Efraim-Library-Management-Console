import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import { authStore } from '@/stores/authStore';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/books",
      name: "books",
      component: () => import("../views/BooksView.vue"),
    },
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginView.vue"),
    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/RegisterView.vue"),
    },
  ],
});


router.beforeEach(async (to, from) => {
  const store = authStore();

  if (!store.isAuthenticated && to.name !== 'login') {
    let userInStorage = store.loadUserDetailsFromStorage();

    if(!userInStorage) {
      return { name: 'login' }
    }
  }
})

export default router;
