<script setup lang="ts">
import { ref } from 'vue'
import { useCart } from '../composables/useCart'
import { laravel, getCurrentUser } from '@/comunication_manager' 

const props = defineProps<{ isOpen: boolean }>()
const emit = defineEmits(['close'])
const { cart, removeFromCart, updateQuantity, totalAmount } = useCart()

const showCheckoutForm = ref(false)
const isSubmitting = ref(false)
const orderSuccess = ref(false)
const errorMessage = ref('')

const formData = ref({
  nombre: '',
  apellido: '',
  email: '',
  telefono: '',
  direccion: '',
  ciudad: '',
  codigo_postal: '',
  notas: ''
})

const formErrors = ref({
  nombre: '',
  apellido: '',
  email: '',
  direccion: '',
  ciudad: '',
  codigo_postal: ''
})

const validateForm = () => {
  let isValid = true
  formErrors.value = {
    nombre: '',
    apellido: '',
    email: '',
    direccion: '',
    ciudad: '',
    codigo_postal: ''
  }

  if (!formData.value.nombre) formErrors.value.nombre = 'El nombre es obligatorio', isValid = false
  if (!formData.value.apellido) formErrors.value.apellido = 'El apellido es obligatorio', isValid = false
  if (!formData.value.email) formErrors.value.email = 'El email es obligatorio', isValid = false
  else if (!/\S+@\S+\.\S+/.test(formData.value.email)) formErrors.value.email = 'Ingrese un email válido', isValid = false
  if (!formData.value.direccion) formErrors.value.direccion = 'La dirección es obligatoria', isValid = false
  if (!formData.value.ciudad) formErrors.value.ciudad = 'La ciudad es obligatoria', isValid = false
  if (!formData.value.codigo_postal) formErrors.value.codigo_postal = 'El código postal es obligatorio', isValid = false

  return isValid
}

const proceedToCheckout = () => showCheckoutForm.value = true

const submitOrder = async () => {
  if (!validateForm()) return;

  isSubmitting.value = true;
  errorMessage.value = '';

  try {
    const token = localStorage.getItem('token');
    if (!token) {
      throw new Error('Debes iniciar sesión para realizar un pedido');
    }

    let user;
    try {
      user = await getCurrentUser();
    } catch (error) {
      console.error('Error verificando usuario:', error);
      throw new Error('Error de conexión con el servidor. Inténtalo de nuevo.');
    }

    if (!user) {
      throw new Error('Debes iniciar sesión para realizar un pedido');
    }

    const items = cart.value.map(item => ({
      producto_id: item.product.id,
      cantidad: item.quantity,
      precio: item.product.price
    }));

    const response = await fetch(`${laravel.URL}/pedidos`, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      },
      body: JSON.stringify({
        ...formData.value,
        items,
        total: totalAmount.value
      })
    });

    if (!response.ok) {
      const errorData = await response.json().catch(() => ({}));
      throw new Error(errorData.message || 'Error en la solicitud');
    }

    orderSuccess.value = true;
    cart.value = [];

    setTimeout(() => {
      showCheckoutForm.value = false;
      orderSuccess.value = false;
      emit('close');
    }, 3000);
  } catch (error) {
    console.error('Error al crear el pedido:', error);
    errorMessage.value = error.message || 'Ha ocurrido un error al procesar tu pedido. Inténtalo de nuevo.';
  } finally {
    isSubmitting.value = false;
  }
}
const goBackToCart = () => showCheckoutForm.value = false
</script>


<template>
  <transition
    enter-active-class="transform transition-transform duration-300 ease-out"
    enter-from-class="translate-x-full"
    enter-to-class="translate-x-0"
    leave-active-class="transform transition-transform duration-200 ease-in"
    leave-from-class="translate-x-0"
    leave-to-class="translate-x-full"
  >
    <div
      v-if="isOpen"
      class="fixed inset-0 z-50"
    >
      <div 
        class="absolute inset-0 bg-black bg-opacity-50 transition-opacity duration-300"
        @click="emit('close')"
      ></div>
      
      <div
        class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-xl"
        @click.stop
      >
        <div class="h-full flex flex-col">
          <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold">Carrito de Compras</h2>
            <button
              @click="emit('close')"
              class="text-gray-500 hover:text-gray-700 transition-colors duration-200"
            >
              <span class="text-2xl">×</span>
            </button>
          </div>

          <div class="flex-1 overflow-y-auto p-6">
            <div v-if="cart.length === 0" class="text-center py-8">
              <p class="text-gray-500">Tu carrito está vacío</p>
            </div>

            <div v-else class="space-y-4">
              <transition-group
                name="list"
                tag="div"
                class="space-y-4"
              >
                <div
                  v-for="item in cart"
                  :key="item.product.id"
                  class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg transform transition-all duration-300 hover:shadow-md"
                >
                  <img
                    :src="item.product.image"
                    :alt="item.product.name"
                    class="w-20 h-20 object-cover rounded transform transition-transform duration-300 hover:scale-105"
                  />
                  
                  <div class="flex-grow">
                    <h3 class="font-semibold">{{ item.product.name }}</h3>
                    <p class="text-blue-600">${{ item.product.price }}</p>
                    
                    <div class="flex items-center gap-2 mt-2">
                      <button
                        @click="updateQuantity(item.product.id, item.quantity - 1)"
                        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition-colors duration-200"
                      >
                        -
                      </button>
                      <span>{{ item.quantity }}</span>
                      <button
                        @click="updateQuantity(item.product.id, item.quantity + 1)"
                        class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 transition-colors duration-200"
                      >
                        +
                      </button>
                      
                      <button @click="removeFromCart(item.product.id)" class="button">
                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                      </button>
                    </div>
                  </div>
                </div>
              </transition-group>
            </div>
          </div>

          <div class="p-6 border-t bg-white">
            <!-- Formulario de Checkout -->
<div v-if="showCheckoutForm" class="p-6 border-t bg-white">
  <h3 class="text-xl font-bold mb-4">Información de Envío</h3>
  
  <form @submit.prevent="submitOrder">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
      <div>
        <label class="block mb-1">Nombre*</label>
        <input v-model="formData.nombre" class="w-full p-2 border rounded">
        <p class="text-red-500 text-sm">{{ formErrors.nombre }}</p>
      </div>
      <div>
        <label class="block mb-1">Apellido*</label>
        <input v-model="formData.apellido" class="w-full p-2 border rounded">
        <p class="text-red-500 text-sm">{{ formErrors.apellido }}</p>
      </div>
      <div>
        <label class="block mb-1">Email*</label>
        <input v-model="formData.email" type="email" class="w-full p-2 border rounded">
        <p class="text-red-500 text-sm">{{ formErrors.email }}</p>
      </div>
      <div>
        <label class="block mb-1">Teléfono</label>
        <input v-model="formData.telefono" class="w-full p-2 border rounded">
      </div>
      <div class="md:col-span-2">
        <label class="block mb-1">Dirección*</label>
        <input v-model="formData.direccion" class="w-full p-2 border rounded">
        <p class="text-red-500 text-sm">{{ formErrors.direccion }}</p>
      </div>
      <div>
        <label class="block mb-1">Ciudad*</label>
        <input v-model="formData.ciudad" class="w-full p-2 border rounded">
        <p class="text-red-500 text-sm">{{ formErrors.ciudad }}</p>
      </div>
      <div>
        <label class="block mb-1">Código Postal*</label>
        <input v-model="formData.codigo_postal" class="w-full p-2 border rounded">
        <p class="text-red-500 text-sm">{{ formErrors.codigo_postal }}</p>
      </div>
      <div class="md:col-span-2">
        <label class="block mb-1">Notas</label>
        <textarea v-model="formData.notas" class="w-full p-2 border rounded"></textarea>
      </div>
    </div>
    
    <div class="flex justify-between items-center text-xl font-bold mb-4">
      <span>Total:</span>
      <span>${{ totalAmount.toFixed(2) }}</span>
    </div>
    
    <div class="flex gap-4">
      <button 
        @click="goBackToCart" 
        type="button" 
        class="flex-1 bg-gray-300 text-gray-800 py-2 rounded-lg hover:bg-gray-400 transition-colors"
      >
        Volver al Carrito
      </button>
      <button 
        type="submit" 
        class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors"
        :disabled="isSubmitting"
      >
        {{ isSubmitting ? 'Procesando...' : 'Confirmar Pedido' }}
      </button>
    </div>
    
    <div v-if="errorMessage" class="mt-4 p-2 bg-red-100 text-red-700 rounded">
      {{ errorMessage }}
    </div>
  </form>
</div>

<!-- Resumen del Carrito (cuando no está mostrando el formulario) -->
<div v-else class="p-6 border-t bg-white">
  <div class="flex justify-between items-center text-xl font-bold mb-4">
    <span>Total:</span>
    <span>${{ totalAmount.toFixed(2) }}</span>
  </div>
  
  <button
    @click="proceedToCheckout"
    class="w-full bg-blue-600 text-white py-3 rounded-lg transform transition-all duration-300 hover:bg-blue-700 hover:scale-105 active:scale-95"
    :disabled="cart.length === 0"
  >
    Proceder al Pago
  </button>
</div>
          </div>
        </div>
      </div>
    </div>
  </transition>
  <!-- Mensaje de éxito (fuera del carrito) -->
<transition name="fade">
  <div 
    v-if="orderSuccess" 
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
  >
    <div class="bg-white p-6 rounded-lg max-w-md mx-4">
      <h3 class="text-xl font-bold mb-2">¡Pedido realizado con éxito!</h3>
      <p class="mb-4">Gracias por tu compra. Te enviaremos un correo de confirmación.</p>
      <button 
        @click="orderSuccess = false; emit('close')" 
        class="w-full bg-blue-600 text-white py-2 rounded-lg"
      >
        Aceptar
      </button>
    </div>
  </div>
</transition>
</template>

<style scoped>

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.list-enter-active,
.list-leave-active {
  transition: all 0.3s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}



</style>

<style scoped>
  .button {
    width: 40px;
    height: 45px;
    border-radius: 50%;
    background-color: rgb(20, 20, 20);
    border: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
    cursor: pointer;
    transition-duration: .3s;
    overflow: hidden;
    position: relative;
  }

  .svgIcon {
    width: 12px;
    transition-duration: .3s;
  }

  .svgIcon path {
    fill: white;
  }

  .button:hover {
    width: 140px;
    border-radius: 50px;
    transition-duration: .3s;
    background-color: rgb(255, 69, 69);
    align-items: center;
  }

  .button:hover .svgIcon {
    width: 50px;
    transition-duration: .3s;
    transform: translateY(60%);
  }

  .button::before {
    position: absolute;
    top: -20px;
    content: "Delete";
    color: white;
    transition-duration: .3s;
    font-size: 2px;
  }

  .button:hover::before {
    font-size: 13px;
    opacity: 1;
    transform: translateY(30px);
    transition-duration: .3s;
  }
</style>

