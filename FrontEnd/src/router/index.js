import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home.vue'
import LoginView from '../views/LoginView.vue'
import RegistreView from '../views/RegistreView.vue'
import store from '../store/store';

import AboutView from '../views/AboutView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true },

    },
    
      {
        path: '/login',
        name: 'login',
        component: LoginView
        
      },
      {
        path: '/registre',
        name: 'registre',
        component: RegistreView,
  
      },
    {
      path: '/about',
      name: 'about',
      component: AboutView
    },
    {
      path: '/:catchAll(.*)',
      redirect: { name: 'home' }, // Redirect to the Home route
    },
  ]
  
})
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.getters.isAuthenticated) {
    // Redirect to the login page if the route requires authentication and the user is not authenticated
    next('/login');
  } else {
    next(); // Continue to the route
  }
});

export default router
