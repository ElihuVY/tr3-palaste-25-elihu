import { ref, computed } from 'vue'
import type { Product, CartItem } from '../types'

const cart = ref<CartItem[]>([])

export function useCart() {
  const addToCart = (product: Product) => {
    const existingItem = cart.value.find(item => item.product.id === product.id)
    
    if (existingItem) {
      existingItem.quantity++
    } else {
      cart.value.push({ product, quantity: 1 })
    }
  }

  const removeFromCart = (productId: number) => {
    const index = cart.value.findIndex(item => item.product.id === productId)
    if (index !== -1) {
      cart.value.splice(index, 1)
    }
  }

  const updateQuantity = (productId: number, quantity: number) => {
    const item = cart.value.find(item => item.product.id === productId)
    if (item) {
      if (quantity <= 0) {
        removeFromCart(productId)
      } else {
        item.quantity = quantity
      }
    }
  }

  const totalItems = computed(() => {
    return cart.value.reduce((total, item) => total + item.quantity, 0)
  })

  const totalAmount = computed(() => {
    return cart.value.reduce((total, item) => total + (item.product.price * item.quantity), 0)
  })

  return {
    cart,
    addToCart,
    removeFromCart,
    updateQuantity,
    totalItems,
    totalAmount
  }
}