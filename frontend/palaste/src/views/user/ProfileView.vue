<script setup>
import { ref, onMounted, computed } from 'vue';
import { useAuthStore } from '@/stores/authStore';

const authStore = useAuthStore();
const activeTab = ref('profile');

// Computed para datos del usuario
const userProfile = computed(() => authStore.getUserProfileData);
const userEmail = computed(() => authStore.getLoginInfo.email);
const userOrders = computed(() => authStore.getUserOrders);
const userProjects = computed(() => authStore.getUserProjectRequests);

// Cargar datos al montar el componente
onMounted(async () => {
  try {
    await authStore.fetchAllProfileData();
  } catch (error) {
    console.error('Error loading profile data:', error);
  }
});

// Función para estilos de estado mejorada
const getStatusConfig = (status) => {
  const configs = {
    pending: { 
      class: 'bg-amber-50 text-amber-800 border-amber-200',
      text: 'Pendiente'
    },
    processing: {
      class: 'bg-slate-100 text-slate-800 border-slate-200',
      text: 'En proceso'
    },
    completed: {
      class: 'bg-teal-50 text-teal-800 border-teal-200',
      text: 'Completado'
    },
    cancelled: {
      class: 'bg-rose-50 text-rose-800 border-rose-200',
      text: 'Cancelado'
    },
    in_review: {
      class: 'bg-violet-50 text-violet-800 border-violet-200',
      text: 'En revisión'
    },
    approved: {
      class: 'bg-teal-50 text-teal-800 border-teal-200',
      text: 'Aprobado'
    },
    rejected: {
      class: 'bg-rose-50 text-rose-800 border-rose-200',
      text: 'Rechazado'
    }
  };
  return configs[status] || { class: 'bg-gray-100 text-gray-800 border-gray-200', text: status };
};

// Formatear fecha
const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};

// Formatear moneda
const formatCurrency = (amount) => {
  return new Intl.NumberFormat('es-ES', { 
    style: 'currency', 
    currency: 'EUR' 
  }).format(amount);
};
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <!-- Loading State -->
    <div v-if="authStore.getProfileLoadingState" class="flex justify-center items-center min-h-[400px]">
      <div class="animate-spin rounded-full h-12 w-12 border-4 border-slate-400 border-t-transparent"></div>
      <span class="ml-3 text-slate-600">Cargando tu perfil...</span>
    </div>

    <!-- Error State -->
    <div v-else-if="authStore.getProfileError" class="text-center p-8">
      <div class="max-w-md mx-auto bg-rose-50 rounded-lg p-6 border border-rose-200">
        <div class="flex flex-col items-center">
          <svg class="h-12 w-12 text-rose-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 class="text-lg font-medium text-rose-800 mb-2">Error al cargar el perfil</h3>
          <p class="text-rose-600">{{ authStore.getProfileError }}</p>
          <button 
            @click="authStore.fetchAllProfileData()"
            class="mt-4 px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 transition-colors"
          >
            Reintentar
          </button>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div v-else class="max-w-6xl mx-auto">
      <!-- Profile Header -->
      <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="md:flex">
          <div class="md:flex-shrink-0 bg-gradient-to-br from-slate-600 to-slate-700 p-8 flex items-center justify-center">
            <div class="h-24 w-24 rounded-full bg-white flex items-center justify-center shadow-lg">
              <span class="text-3xl font-bold text-slate-600">
                {{ userProfile?.name?.charAt(0) || userEmail?.charAt(0) || 'U' }}
              </span>
            </div>
          </div>
          <div class="p-8 flex-1">
            <div class="uppercase tracking-wide text-sm text-slate-500 font-semibold">Mi perfil</div>
            <h1 class="mt-1 text-2xl font-bold text-slate-800">{{ userProfile?.name || 'Usuario' }}</h1>
            <p class="mt-2 text-slate-600">{{ userEmail }}</p>
            <div class="mt-4 flex items-center text-sm text-slate-500">
              <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              Miembro desde {{ formatDate(userProfile?.created_at) }}
            </div>
          </div>
        </div>
      </div>

      <!-- Navigation Tabs -->
      <div class="flex overflow-x-auto mb-8 border-b border-slate-200">
        <button
          v-for="tab in [
            { id: 'profile', name: 'Perfil' },
            { id: 'orders', name: 'Mis Pedidos' },
            { id: 'projects', name: 'Mis Proyectos' }
          ]"
          :key="tab.id"
          @click="activeTab = tab.id"
          :class="[
            'px-6 py-3 font-medium text-sm tracking-wide transition-colors duration-200 relative',
            activeTab === tab.id
              ? 'text-slate-800 border-b-2 border-slate-600'
              : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50'
          ]"
        >
          {{ tab.name }}
          <span 
            v-if="tab.id === 'orders' && userOrders.length > 0" 
            class="ml-2 px-2 py-0.5 rounded-full bg-slate-100 text-slate-800 text-xs"
          >
            {{ userOrders.length }}
          </span>
          <span 
            v-if="tab.id === 'projects' && userProjects.length > 0" 
            class="ml-2 px-2 py-0.5 rounded-full bg-slate-100 text-slate-800 text-xs"
          >
            {{ userProjects.length }}
          </span>
        </button>
      </div>

      <!-- Tab Content -->
      <div>
        <!-- Profile Tab -->
        <div v-if="activeTab === 'profile'" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
          <div class="p-8">
            <h2 class="text-xl font-semibold mb-6 text-slate-800">Información Personal</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nombre completo</label>
                <input
                  type="text"
                  :value="userProfile?.name"
                  class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent"
                  disabled
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Correo electrónico</label>
                <input
                  type="email"
                  :value="userEmail"
                  class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent"
                  disabled
                />
              </div>
              
            </div>
            
            <div class="mt-8">
              <h3 class="text-lg font-medium text-slate-800 mb-4">Estadísticas</h3>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                  <p class="text-sm text-slate-600 font-medium">Pedidos totales</p>
                  <p class="text-2xl font-bold text-slate-800">{{ userOrders.length }}</p>
                </div>
                <div class="bg-teal-50 rounded-lg p-4 border border-teal-200">
                  <p class="text-sm text-teal-600 font-medium">Proyectos activos</p>
                  <p class="text-2xl font-bold text-teal-800">
                    {{ userProjects.filter(p => ['pending', 'processing', 'in_review'].includes(p.status)).length }}
                  </p>
                </div>
                <div class="bg-violet-50 rounded-lg p-4 border border-violet-200">
                  <p class="text-sm text-violet-600 font-medium">Miembro desde</p>
                  <p class="text-xl font-bold text-violet-800">{{ new Date(userProfile?.created_at).getFullYear() }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Orders Tab -->
        <div v-if="activeTab === 'orders'">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-slate-800">Mis Pedidos</h2>
            <div class="text-sm text-slate-500">
              Mostrando {{ userOrders.length }} pedido{{ userOrders.length !== 1 ? 's' : '' }}
            </div>
          </div>
          
          <div v-if="userOrders.length === 0" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden py-12 text-center">
            <div class="max-w-md mx-auto">
              <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
              <h3 class="mt-2 text-lg font-medium text-slate-900">No tienes pedidos</h3>
              <p class="mt-1 text-slate-500">Tus pedidos aparecerán aquí cuando realices una compra.</p>
              <div class="mt-6">
                <button class="px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 transition-colors">
                  Ver productos
                </button>
              </div>
            </div>
          </div>

          <div v-else class="space-y-4">
            <div
              v-for="order in userOrders"
              :key="order.id"
              class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200 overflow-hidden"
            >
              <div class="p-6">
                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                  <div>
                    <h3 class="font-semibold text-lg text-slate-800">Pedido #{{ order.id }}</h3>
                    <p class="text-sm text-slate-500">
                      {{ formatDate(order.created_at) }}
                    </p>
                  </div>
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-sm font-medium border',
                      getStatusConfig(order.status).class
                    ]"
                  >
                    {{ getStatusConfig(order.status).text }}
                  </span>
                </div>
                
                <div class="border-t border-slate-100 pt-4 mt-4">
                  <div class="space-y-3">
                    <div
                      v-for="item in order.items"
                      :key="item.id"
                      class="flex justify-between items-center"
                    >
                      <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0 h-10 w-10 bg-slate-100 rounded-md flex items-center justify-center">
                          <span class="text-slate-500 text-xs">IMG</span>
                        </div>
                        <div>
                          <p class="text-sm font-medium text-slate-800">{{ item.product.name }}</p>
                          <p class="text-xs text-slate-500">Cantidad: {{ item.quantity }}</p>
                        </div>
                      </div>
                      <span class="text-sm font-medium">{{ formatCurrency(item.price) }}</span>
                    </div>
                  </div>
                  
                  <div class="mt-6 pt-4 border-t border-slate-100 flex justify-between items-center">
                    <div>
                      <p class="text-sm text-slate-500">Método de pago:</p>
                      <p class="text-sm font-medium">{{ order.payment_method || 'No especificado' }}</p>
                    </div>
                    <div class="text-right">
                      <p class="text-sm text-slate-500">Total</p>
                      <p class="text-lg font-bold">{{ formatCurrency(order.total) }}</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="bg-slate-50 px-6 py-3 flex justify-end border-t border-slate-200">
                <button class="text-sm font-medium text-slate-700 hover:text-slate-900 transition-colors">
                  Ver detalles del pedido
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Projects Tab -->
        <div v-if="activeTab === 'projects'">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-slate-800">Mis Solicitudes de Proyectos</h2>
            <div class="text-sm text-slate-500">
              Mostrando {{ userProjects.length }} proyecto{{ userProjects.length !== 1 ? 's' : '' }}
            </div>
          </div>
          
          <div v-if="userProjects.length === 0" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden py-12 text-center">
            <div class="max-w-md mx-auto">
              <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
              </svg>
              <h3 class="mt-2 text-lg font-medium text-slate-900">No tienes proyectos</h3>
              <p class="mt-1 text-slate-500">Tus solicitudes de proyectos aparecerán aquí cuando las envíes.</p>
              <div class="mt-6">
                <button class="px-4 py-2 bg-slate-700 text-white rounded-md hover:bg-slate-800 transition-colors">
                  Solicitar nuevo proyecto
                </button>
              </div>
            </div>
          </div>

          <div v-else class="space-y-4">
            <div
              v-for="project in userProjects"
              :key="project.id"
              class="bg-white rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow duration-200 overflow-hidden"
            >
              <div class="p-6">
                <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                  <div>
                    <h3 class="font-semibold text-lg text-slate-800">{{ project.title }}</h3>
                    <p class="text-sm text-slate-500">
                      {{ formatDate(project.created_at) }}
                    </p>
                  </div>
                  <span
                    :class="[
                      'px-3 py-1 rounded-full text-sm font-medium border',
                      getStatusConfig(project.status).class
                    ]"
                  >
                    {{ getStatusConfig(project.status).text }}
                  </span>
                </div>
                
                <p class="text-slate-600 mb-4">{{ project.description }}</p>
                
                <div v-if="project.notes" class="bg-amber-50 border-l-4 border-amber-400 p-4 mb-4">
                  <div class="flex">
                    <div class="flex-shrink-0">
                      <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                      </svg>
                    </div>
                    <div class="ml-3">
                      <p class="text-sm text-amber-700">
                        {{ project.notes }}
                      </p>
                    </div>
                  </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-slate-100 flex flex-wrap gap-2">
                  <span 
                    v-for="(tag, index) in project.tags" 
                    :key="index"
                    class="px-2 py-1 bg-slate-100 text-slate-800 text-xs rounded-full"
                  >
                    {{ tag }}
                  </span>
                </div>
              </div>
              
              <div class="bg-slate-50 px-6 py-3 flex justify-between items-center border-t border-slate-200">
                <div class="text-sm text-slate-500">
                  Última actualización: {{ formatDate(project.updated_at) }}
                </div>
                <button class="text-sm font-medium text-slate-700 hover:text-slate-900 transition-colors">
                  Ver detalles del proyecto
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>