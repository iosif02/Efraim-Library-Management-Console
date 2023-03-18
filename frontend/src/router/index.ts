import { createRouter, createWebHistory } from "vue-router";
import { authStore } from '@/stores/auth-store';
import authRoutes from "@/router/auth-routes";
import bookRoutes from "@/router/book-routes";
import entityRoutes from "@/router/entity-routes";
import userRoutes from "@/router/user-router";
import homeRoutes from "@/router/home-routes";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    authRoutes,
    homeRoutes,
    bookRoutes,
    entityRoutes,
    userRoutes
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
