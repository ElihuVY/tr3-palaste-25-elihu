import { createRouter, createWebHistory } from 'vue-router';

import HomeView from '@/views/HomeView.vue';
import BudgetView from '@/views/BudgetView.vue';
import ShopView from '@/views/ShopView.vue';

import LoginView from '@/views/user/LoginView.vue';
import RegisterView from '@/views/user/RegisterView.vue';
import ProfileView from '@/views/user/ProfileView.vue';

const router = createRouter({
  history: createWebHistory(), 
  routes,
});

const routes = [
  {
    path: '/', 
    name: 'home',
    component: HomeView,
  },
  {
    path: '/presupuesto', 
    name: 'budget',
    component: BudgetView,
  },
  {
    path: '/tienda', 
    name: 'shop',
    component: ShopView,
  },
  {
    path: '/iniciar-sesion', 
    name: 'login',
    component: LoginView,
  },
  {
    path: '/registro', 
    name: 'register',
    component: RegisterView,
  },
  {
    path: '/perfil', 
    name: 'profile',
    component: ProfileView,
  },
  
  // ruta para manejar páginas no encontradas (404)
  {
    path: '/:pathMatch(.*)*', 
    redirect: '/', // Redirige a la página principal 
  },
];



// TODO: Middleware para proteger rutas que requieren autenticación


export default router;