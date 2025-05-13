<script setup>
import ChatIA from '@/components/ChatIA.vue';
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-6 md:py-12 px-3 sm:px-6 lg:px-8">
    <div class="container mx-auto max-w-6xl">
      <!-- En-tête amélioré -->
      <div class="text-center mb-6 md:mb-12">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-3 md:mb-4">
          Demandez votre <span class="text-blue-900">Devis</span>
        </h1>
        <p class="text-base md:text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed px-4">
          Notre assistant virtuel vous guidera étape par étape pour recueillir tous les détails de votre projet.
        </p>
      </div>

      <!-- Carte de chat améliorée -->
      <div class="bg-white rounded-lg md:rounded-xl shadow-lg md:shadow-xl overflow-hidden">
        <!-- Barre supérieure de la carte -->
        <div class="bg-blue-900 px-4 md:px-6 py-3 md:py-4 flex items-center">
          <div class="flex items-center space-x-1 md:space-x-2">
            <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-red-400"></div>
            <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-yellow-400"></div>
            <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-green-400"></div>
          </div>
          <div class="ml-3 md:ml-4 text-white text-sm md:text-base font-medium">
            Assistant Virtuel
          </div>
        </div>
        
        <!-- Composant de chat -->
        <div class="p-2 md:p-4">
          <ChatIA />
        </div>
      </div>

      <!-- Section d'informations supplémentaires -->
      <div class="mt-8 md:mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8 px-2 md:px-0">
        <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
          <div class="text-blue-500 mb-3 md:mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-10 md:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <h3 class="text-lg md:text-xl font-semibold mb-2">Devis Précis</h3>
          <p class="text-sm md:text-base text-gray-600">Recevez un devis détaillé basé sur vos exigences exactes.</p>
        </div>
        
        <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
          <div class="text-blue-500 mb-3 md:mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-10 md:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-lg md:text-xl font-semibold mb-2">Réponse Rapide</h3>
          <p class="text-sm md:text-base text-gray-600">Notre système vous répond en temps réel 24h/24.</p>
        </div>
        
        <div class="bg-white p-4 md:p-6 rounded-lg shadow-md">
          <div class="text-blue-500 mb-3 md:mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-10 md:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
          </div>
          <h3 class="text-lg md:text-xl font-semibold mb-2">Sans Engagement</h3>
          <p class="text-sm md:text-base text-gray-600">Obtenez votre devis sans frais ni obligation d'achat.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.bg-white {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

@media (min-width: 768px) {
  .bg-white:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
  }
}
</style>