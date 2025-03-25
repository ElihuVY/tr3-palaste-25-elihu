<template>
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex items-center">
              <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
            </div>
            <div class="flex items-center">
              <span class="mr-4 text-gray-700">{{ authStore.usuario?.nombre }}</span>
              <button
                @click="authStore.cerrarSesion"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700"
              >
                Cerrar Sesión
              </button>
            </div>
          </div>
        </div>
      </nav>
  
      <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
          <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 flex items-center justify-center">
            <p class="text-gray-500 text-xl">Bienvenido al Dashboard</p>
          </div>
        </div>
      </main>
    </div>
  </template>
  
  <script setup>
  import { useAuthStore } from '../stores/authStore'
  
  const authStore = useAuthStore()
  </script>