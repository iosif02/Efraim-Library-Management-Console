import { createRouter, createWebHistory } from "vue-router";
import { authStore } from '@/stores/authStore';
import authRoutes from "@/router/auth-routes";
import bookRoutes from "@/router/book-routes";
import readerRoutes from "@/router/reader-routes"
import profileRoutes from "@/router/profile-routes"
import authorsRoutes from "@/router/authors-routes"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    authRoutes,
    bookRoutes,
    readerRoutes,
    profileRoutes,
    authorsRoutes
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
