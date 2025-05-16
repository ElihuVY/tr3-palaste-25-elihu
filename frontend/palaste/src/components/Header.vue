<script setup>
import { useAuthStore } from '@/stores/authStore.js';
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';

const authStore = useAuthStore();
const visibleLog = ref(false);
const router = useRouter();
const isMenuOpen = ref(false);

const isLoggedIn = computed(() => authStore.getLoginInfo.loggedIn);

async function salir() {
  authStore.setLoginInfo({
    loggedIn: false,
    username: '',
    email: '',
    token: '',
  });
  visibleLog.value = false;
  router.push('/home');
}

function closeMenu() {
  isMenuOpen.value = false;
}

function toggleMenu() {
  isMenuOpen.value = !isMenuOpen.value;
}

visibleLog.value = isLoggedIn.value;
</script>

<template>
  <nav class="bg-gray-800 shadow-lg relative z-50">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center h-16">
        <router-link to="/" class="text-4xl font-bold text-white hover:text-gray-300 transition">
          PALASTE
        </router-link>

        <!-- Hamburger Menu Button -->
        <button class="text-white md:hidden focus:outline-none" @click="toggleMenu">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
          </svg>
        </button>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-4">
          <router-link to="/" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
            Accueil
          </router-link>
          <router-link to="/galeria" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
            Galerie
          </router-link>
          <router-link to="/presupuesto"
            class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
            Demander un Projet
          </router-link>

          <template v-if="!isLoggedIn">
            <router-link to="/iniciar-sesion"
              class="bg-gray-700 text-white hover:bg-gray-600 px-4 py-2 rounded-md transition duration-300 font-semibold">
              Se Connecter
            </router-link>
          </template>

          <template v-else>
            <router-link to="/perfil" class="text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300">
              Profil
            </router-link>

            <button @click="salir" class="text-white hover:bg-red-600 px-4 py-2 rounded-md transition duration-300">
              Déconnexion
            </button>
          </template>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div 
    v-if="isMenuOpen" 
    class="absolute top-16 left-0 w-full bg-gray-800 space-y-2 py-4 z-40"
  >
    <router-link 
      @click="closeMenu"
      to="/" 
      class="block text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300"
    >
      Accueil
    </router-link>
    <router-link 
      @click="closeMenu"
      to="/galeria" 
      class="block text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300"
    >
      Galerie
    </router-link>
    <router-link 
      @click="closeMenu"
      to="/presupuesto" 
      class="block text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300"
    >
      Demander un Projet
    </router-link>
    
    <template v-if="!isLoggedIn">
      <router-link 
        @click="closeMenu"
        to="/iniciar-sesion" 
        class="block bg-gray-700 text-white hover:bg-gray-600 px-4 py-2 rounded-md transition duration-300 font-semibold"
      >
        Se Connecter
      </router-link>
    </template>
    
    <template v-else>
      <router-link 
        @click="closeMenu"
        to="/perfil" 
        class="block text-white hover:bg-gray-700 px-4 py-2 rounded-md transition duration-300"
      >
        Profil
      </router-link>

      <button 
        @click="() => { salir(); closeMenu(); }" 
        class="block text-white hover:bg-red-600 px-4 py-2 rounded-md transition duration-300"
      >
        Déconnexion
      </button>
    </template>
  </div>
    </div>
  </nav>
</template>