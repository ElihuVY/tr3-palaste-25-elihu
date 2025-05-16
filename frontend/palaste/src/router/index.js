import { createRouter, createWebHistory } from 'vue-router';

import HomeView from '@/views/HomeView.vue';
import BudgetView from '@/views/BudgetView.vue';
import galeria from '@/views/Galeria.vue';

import LoginView from '@/views/user/LoginView.vue';
import RegisterView from '@/views/user/RegisterView.vue';
import ProfileView from '@/views/user/ProfileView.vue';
import Dashboard from '@/views/Dashboard.vue';

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
    path: '/galeria', 
    name: 'galeria',
    component: galeria,
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
  {
    path: '/dashboard',
    component: Dashboard,
    meta: { requiresAuth: true }
  },
  
  // ruta para manejar páginas no encontradas (404)
  {
    path: '/:pathMatch(.*)*', 
    redirect: '/', // Redirige a la página principal 
  },
];

const router = createRouter({
  history: createWebHistory(), 
  routes,
});


// TODO: Middleware para proteger rutas que requieren autenticación


export default router;