import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null)
  const isAuthenticated = ref(false)

  const login = (credentials) => {
    // Implementar lógica de login aquí
    isAuthenticated.value = true
    user.value = { email: credentials.email }
  }

  const register = (userData) => {
    // Implementar lógica de registro aquí
    isAuthenticated.value = true
    user.value = { email: userData.email }
  }

  const logout = () => {
    user.value = null
    isAuthenticated.value = false
  }

  return {
    user,
    isAuthenticated,
    login,
    register,
    logout
  }
})
