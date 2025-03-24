<script setup lang="ts">
import { ref, computed } from 'vue'
import type { Product } from '../types'
import { useCart } from '../composables/useCart'
import ProductModal from '../components/ProductModal.vue'
import ShoppingCart from '@/components/ShoppingCart.vue'

const productos = ref<Product[]>([
  {
    id: 1,
    name: 'Máscara de Soldadura Automática',
    price: 299.99,
    category: 'Máscaras',
    image: 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122',
    description: 'Máscara automática con filtro ajustable para una protección óptima durante la soldadura. Incluye sensores automáticos y filtro UV/IR.'
  },
  {
    id: 2,
    name: 'Guantes de Soldador Premium',
    price: 49.99,
    category: 'Guantes',
    image: 'https://images.unsplash.com/photo-1578324510673-9c262f397456',
    description: 'Guantes resistentes al calor fabricados con materiales de alta calidad para máxima protección y durabilidad.'
  },
  {
    id: 3,
    name: 'Botas de Seguridad',
    price: 129.99,
    category: 'Botas',
    image: 'https://images.unsplash.com/photo-1595341888016-a392ef81b7de',
    description: 'Botas con punta de acero y suela antideslizante. Diseñadas para máxima comodidad y protección durante largas jornadas de trabajo.'
  },
  {
    id: 4,
    name: 'Soldadora MIG',
    price: 799.99,
    category: 'Herramientas',
    image: 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1',
    description: 'Soldadora profesional MIG con control digital y múltiples configuraciones para diferentes tipos de materiales y espesores.'
  }
])

const categorias = ['Máscaras', 'Guantes', 'Botas', 'Herramientas']
const categoriaSeleccionada = ref<string | null>(null)
const buscador = ref('')
const rangoPrecio = ref([0, 1000])
const productoSeleccionado = ref<Product | null>(null)
const isCartOpen = ref(false)

const { cart, addToCart, totalItems } = useCart()

// Filtrar productos
const filtrarProductos = computed(() => {
  return productos.value
    .filter(producto => {
      const matchesCategory = !categoriaSeleccionada.value || producto.category === categoriaSeleccionada.value
      const matchesSearch = producto.name.toLowerCase().includes(buscador.value.toLowerCase())
      const matchesPrice = producto.price >= rangoPrecio.value[0] && producto.price <= rangoPrecio.value[1]
      return matchesCategory && matchesSearch && matchesPrice
    })
    .sort((a, b) => b.price - a.price)
})

// Alternar categoría seleccionada
const seleccionC = (category: string) => {
  categoriaSeleccionada.value = categoriaSeleccionada.value === category ? null : category
}

// Abrir detalle del producto
const openProduct = (producto: Product) => {
  productoSeleccionado.value = producto
}

// Cerrar modal
const closeProduct = () => {
  productoSeleccionado.value = null
}

// Sugerencias de productos
const sugerirProductos = computed(() => {
  if (!productoSeleccionado.value) return []
  return productos.value
    .filter(p => p.category === productoSeleccionado.value?.category && p.id !== productoSeleccionado.value?.id)
    .slice(0, 3)
})
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold">Tienda PALASTE</h1>
      
      <!-- Carrito -->
      <button
        @click="isCartOpen = true"
        class="relative bg-blue-600 text-white px-4 py-2 rounded-lg transform transition-all duration-300 hover:bg-blue-700 hover:scale-105 active:scale-95"
      >
        🛒 Carrito
        <transition
          enter-active-class="transform transition-all duration-300"
          enter-from-class="opacity-0 scale-50"
          enter-to-class="opacity-100 scale-100"
          leave-active-class="transform transition-all duration-200"
          leave-from-class="opacity-100 scale-100"
          leave-to-class="opacity-0 scale-50"
        >
          <span
            v-if="totalItems > 0"
            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm"
          >
            {{ totalItems }}
          </span>
        </transition>
      </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <!-- Filtros -->
      <div class="col-span-1">
        <div class="sticky top-4">
          <div class="mb-6">
            <input 
              v-model="buscador"
              type="text"
              placeholder="Buscar producto..."
              class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
            />
          </div>
          
          <h3 class="font-semibold mb-4">Categorías</h3>
          <div class="space-y-2">
            <button
              v-for="category in categorias"
              :key="category"
              @click="seleccionC(category)"
              :class="[
                'w-full text-left px-4 py-2 rounded-lg transition-all duration-300',
                categoriaSeleccionada === category
                  ? 'bg-blue-600 text-white scale-105 shadow-md'
                  : 'bg-gray-100 hover:bg-gray-200'
              ]"
            >
              {{ category }}
            </button>
          </div>

          <div class="mt-8">
            <h3 class="font-semibold mb-4">Rango de Precio</h3>
            <div class="px-4">
              <input
                type="range"
                v-model="rangoPrecio[1]"
                :min="rangoPrecio[0]"
                max="1000"
                class="w-full accent-blue-600"
              />
              <div class="flex justify-between mt-2">
                <span>${{ rangoPrecio[0] }}</span>
                <span>${{ rangoPrecio[1] }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Grid de productos -->
      <div class="col-span-3">
        <transition-group
          name="products-grid"
          tag="div"
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
        >
          <div
            v-for="producto in filtrarProductos"
            :key="producto.id"
            class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
          >
            <div
              class="h-48 overflow-hidden cursor-pointer"
              @click="openProduct(producto)"
            >
              <img
                :src="producto.image"
                :alt="producto.name"
                class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-110"
              />
            </div>
            <div class="p-4">
              <h3 class="text-lg font-semibold">{{ producto.name }}</h3>
              <p class="text-gray-600 mt-2 line-clamp-2">{{ producto.description }}</p>
              <div class="mt-4 flex justify-between items-center">
                <span class="text-xl font-bold">${{ producto.price }}</span>
                
                <div class="button">
                  <div class="button-wrapper" @click="addToCart(producto)">
                      <div class="text" >Agregar</div>
                      <span class="icon">
                        <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                        </svg>
                      </span>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </transition-group>
      </div>
    </div>

    <!-- Modal de producto -->
    <ProductModal
      :product="productoSeleccionado"
      :suggested-products="sugerirProductos"
      @close="closeProduct"
      @open-product="openProduct"
    />

    <!-- Carrito -->
    <ShoppingCart
      :is-open="isCartOpen"
      @close="isCartOpen = false"
    />
  </div>
</template>

<style scoped>
.products-grid-enter-active,
.products-grid-leave-active {
  transition: all 0.3s ease;
}
.products-grid-enter-from,
.products-grid-leave-to {
  opacity: 0;
  transform: translateY(30px);
}

.button {
    --width: 100px;
    --height: 35px;
    --tooltip-height: 35px;
    --tooltip-width: 90px;
    --gap-between-tooltip-to-button: 18px;
    --button-color: #222;
    --button-hover-color: #28a745;
    --tooltip-color: #fff;
    width: var(--width);
    height: var(--height);
    background: var(--button-color);
    position: relative;
    text-align: center;
    border-radius: 0.45em;
    font-family: "Arial";
    transition: background 0.3s;
    cursor: pointer;
  }

  .button::before {
    position: absolute;
    content: attr(data-tooltip);
    width: var(--tooltip-width);
    height: var(--tooltip-height);
    background-color: #555;
    font-size: 0.9rem;
    color: #fff;
    border-radius: .25em;
    line-height: var(--tooltip-height);
    bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) + 10px);
    left: calc(50% - var(--tooltip-width) / 2);
  }

  

  .button::after,.button::before {
    opacity: 0;
    visibility: hidden;
    transition: all 0.5s;
  }

  .text {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .button-wrapper,.text,.icon {
    overflow: hidden;
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    color: #fff;
  }

  .text {
    top: 0
  }

  .text,.icon {
    transition: top 0.5s;
  }

  .icon {
    color: #fff;
    top: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .icon svg {
    width: 24px;
    height: 24px;
  }

  .button:hover {
    background: #28a745;
  }

  .button:hover .text {
    top: -100%;
  }

  .button:hover .icon {
    top: 0;
  }

  .button:hover:before,.button:hover:after {
    opacity: 1;
    visibility: visible;
  }

  .button:hover:after {
    bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) - 20px);
  }

  .button:hover:before {
    bottom: calc(var(--height) + var(--gap-between-tooltip-to-button));
  }
</style>