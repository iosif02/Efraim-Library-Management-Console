import { createRouter, createWebHistory } from "vue-router";
import { authStore } from '@/stores/authStore';
import MainLayout from "@/views/Layouts/MainLayout.vue";
// import BooksHomeView from "@/views/Pages/Books/BooksHomeView.vue";
// import ReadersView from "@/views/Pages/Readers/ReadersView.vue";
// import AuthorsView from "@/views/Pages/Authors/AuthorsView.vue";
// import AboutView from "@/views/Pages/AboutView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "auth",
      component: import("@/views/Layouts/AuthLayout.vue"),
      redirect: { name: 'login' },
      children: [
        {
          path: "/login",
          name: "login",
          component: () => import("@/views/Auth/LoginView.vue"),
        },
        {
          path: "/register",
          name: "register",
          component: () => import("@/views/Auth/RegisterView.vue"),
        },
      ]
    },
    {
      path: "/",
      name: "home",
      component: MainLayout,
      redirect: { name: 'books' },
      children: [
        {
          path: "/books",
          name: "books",
          component: () => import("@/views/Pages/Books/BooksHomeView.vue")
          // component: BooksHomeView
        },
        {
          path: "/readers",
          name: "readers",
          component: () => import("@/views/Pages/Readers/ReadersView.vue")
          // component: ReadersView
        },
        {
          path: "/authors",
          name: "authors",
          component: () => import("@/views/Pages/Authors/AuthorsView.vue")
          // component: AuthorsView
        },
        {
          path: "/profile",
          name: "profile",
          component: () => import("@/views/Pages/AboutView.vue")
          // component: AboutView
        }
      ]
    }
  ],
});


// router.beforeEach(async (to, from) => {
//   const store = authStore();

//   if (to.name !== 'login' && to.name !== 'register') {
//     store.loadUserDetailsFromStorage();
//     if(!store.isAuthenticated) {
//       return { name: 'login' }
//     }
//   }
//   if (to.name == 'login' ||  to.name == 'register') {
//     store.loadUserDetailsFromStorage();
//     if(store.isAuthenticated) {
//       return { name: 'home' }
//     }
//   }
// })

export default router;
