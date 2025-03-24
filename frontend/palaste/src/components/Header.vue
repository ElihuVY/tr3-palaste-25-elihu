<script setup>
import { useAuthStore } from '@/stores/counter.js';

const authStore = useAuthStore();
</script>

<template>
  <nav class="bg-gray-800 shadow-lg">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center h-16">
        <router-link to="/" class="text-4xl font-bold text-white hover:text-gray-300 transition">
          PALASTE
        </router-link>

        <div class="flex space-x-4">
          <router-link to="/" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
            Inicio
          </router-link>
          <router-link to="/tienda" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
            Tienda
          </router-link>
          <router-link to="/presupuesto" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
            Solicita tu Proyecto
          </router-link>
          
          <template v-if="!authStore.isAuthenticated">
            <router-link to="/iniciar-sesion" class="bg-gray-700 text-white hover:bg-gray-600 px-4 py-2 rounded-md transition duration-300 font-semibold">
              Iniciar Sesión
            </router-link>
          </template>
          
          <template v-else>
            <router-link to="/perfil" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
              Perfil
            </router-link>
            <button @click="authStore.logout" class="text-white hover:bg-red-600 px-4 py-2 rounded-md transition duration-300">
              Cerrar Sesión
            </button>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>