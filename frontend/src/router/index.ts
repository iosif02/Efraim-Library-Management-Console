import { createRouter, createWebHistory } from "vue-router";
import { authStore } from '@/stores/authStore';
import MainLayout from "@/views/Layouts/MainLayout.vue";
import AuthLayout from "@/views/Layouts/AuthLayout.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "auth",
      component: AuthLayout,
      redirect: { name: 'login' },
      children: [
        {
          path: "/login",
          name: "login",
          component: () => import("@/views/LoginView.vue"),
        },
        {
          path: "/register",
          name: "register",
          component: () => import("@/views/RegisterView.vue"),
        },
      ]
    },
    {
      path: "/",
      name: "home",
      component: MainLayout,
      children: [
        {
          path: "/about",
          name: "about",
          component: () => import("@/views/AboutView.vue"),
        },
        {
          path: "/books",
          name: "books",
          component: () => import("@/views/BooksView.vue"),
        },
        {
          path: "/profile",
          name: "profile",
          component: () => import("@/views/AboutView.vue"),
        },
      ]
    },
  ],
});


router.beforeEach(async (to, from) => {
  const store = authStore();

  if (to.name !== 'login' && to.name !== 'register') {
    store.loadUserDetailsFromStorage();
    if(!store.isAuthenticated) {
      return { name: 'login' }
    }
  }
  if (to.name == 'login' ||  to.name == 'register') {
    store.loadUserDetailsFromStorage();
    if(store.isAuthenticated) {
      return { name: 'home' }
    }
  }
})

export default router;
