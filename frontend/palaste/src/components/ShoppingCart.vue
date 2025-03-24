<script setup lang="ts">
import { defineProps, defineEmits } from 'vue'
import { useCart } from '../composables/useCart'

const props = defineProps<{
  isOpen: boolean
}>()

const emit = defineEmits(['close'])
const { cart, removeFromCart, updateQuantity, totalAmount } = useCart()
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
            <div class="flex justify-between items-center text-xl font-bold mb-4">
              <span>Total:</span>
              <span>${{ totalAmount.toFixed(2) }}</span>
            </div>
            
            <button
              class="w-full bg-blue-600 text-white py-3 rounded-lg transform transition-all duration-300 hover:bg-blue-700 hover:scale-105 active:scale-95"
            >
              Proceder al Pago
            </button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<style scoped>
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

