<script setup>
import ChatIA from '@/components/chatIA.vue';
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto max-w-6xl">
      <!-- Encabezado mejorado -->
      <div class="text-center mb-12">
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4">
          Solicita tu <span class="text-blue-600">Presupuesto</span> con Palaste
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
          Nuestro asistente virtual te guiará paso a paso para recopilar todos los detalles de tu proyecto
          y ofrecerte la mejor cotización personalizada.
        </p>
      </div>

      <!-- Tarjeta de chat mejorada -->
      <div class="bg-white rounded-xl shadow-xl overflow-hidden">
        <!-- Barra superior de la tarjeta -->
        <div class="bg-blue-600 px-6 py-4 flex items-center">
          <div class="flex items-center space-x-2">
            <div class="w-3 h-3 rounded-full bg-red-400"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
            <div class="w-3 h-3 rounded-full bg-green-400"></div>
          </div>
          <div class="ml-4 text-white font-medium">
            Asistente Virtual de Presupuestos
          </div>
        </div>
        
        <!-- Componente de chat -->
        <div class="p-1">
          <ChatIA />
        </div>
      </div>

      <!-- Sección de información adicional -->
      <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="text-blue-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Cotización Precisa</h3>
          <p class="text-gray-600">Recibe un presupuesto detallado basado en tus requerimientos exactos.</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="text-blue-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Respuesta Rápida</h3>
          <p class="text-gray-600">Nuestro sistema te responde en tiempo real las 24 horas del día.</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
          <div class="text-blue-500 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Sin Compromiso</h3>
          <p class="text-gray-600">Recibe tu presupuesto sin ningún costo ni obligación de compra.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Animación sutil para la tarjeta del chat */
.bg-white {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.bg-white:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}
</style>