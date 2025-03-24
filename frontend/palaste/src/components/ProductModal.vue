<script setup lang="ts">
import { defineProps, defineEmits } from 'vue'
import type { Product } from '../types'
import { useCart } from '../composables/useCart'

const props = defineProps<{
  product: Product | null
  suggestedProducts: Product[]
}>()

const emit = defineEmits(['close', 'openProduct'])
const { addToCart } = useCart()

const handleAddToCart = (product: Product) => {
  addToCart(product)
}
</script>

<template>
  <transition
    enter-active-class="transition-opacity duration-300 ease-out"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition-opacity duration-200 ease-in"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div v-if="product" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
      <div 
        class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300"
        :class="product ? 'scale-100 opacity-100' : 'scale-95 opacity-0'"
      >
        <div class="relative">
          <button
            @click="emit('close')"
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 transition-colors duration-200"
          >
            <span class="text-2xl">×</span>
          </button>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
            <div class="overflow-hidden rounded-lg">
              <img
                :src="product.image"
                :alt="product.name"
                class="w-full h-96 object-cover transform hover:scale-105 transition-transform duration-500"
              />
            </div>
            
            <div class="space-y-6">
              <h2 class="text-3xl font-bold">{{ product.name }}</h2>
              <p class="text-gray-600">{{ product.description }}</p>
              <div class="text-2xl font-bold text-blue-600">${{ product.price }}</div>
              
              <button
                @click="handleAddToCart(product)"
                class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 active:scale-95"
              >
                Añadir al Carrito
              </button>
            </div>
          </div>

          <div class="p-6 border-t">
            <h3 class="text-xl font-semibold mb-4">Productos relacionados</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div
                v-for="suggestedProduct in suggestedProducts"
                :key="suggestedProduct.id"
                class="cursor-pointer rounded-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                @click="emit('openProduct', suggestedProduct)"
              >
                <div class="overflow-hidden">
                  <img
                    :src="suggestedProduct.image"
                    :alt="suggestedProduct.name"
                    class="w-full h-48 object-cover transform transition-transform duration-500 hover:scale-110"
                  />
                </div>
                <div class="p-4">
                  <h4 class="font-semibold">{{ suggestedProduct.name }}</h4>
                  <p class="text-blue-600 font-bold">${{ suggestedProduct.price }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>