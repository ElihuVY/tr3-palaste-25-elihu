<template>
  <div class="text-center">
    <div class="text-3xl font-bold text-white mb-2">
      <button @click="$router.push('/home')" class="hover:underline">PALASTE</button>
    </div>
    <h2 class="text-lg text-gray-400 mb-6">Inicia sesión</h2>

    <form class="space-y-4">
      <div class="relative">
        <input 
          type="text" 
          placeholder="Usuario" 
          class="w-full p-3 pl-10 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
          xmlns="http://www.w3.org/2000/svg" 
          fill="currentColor" 
          viewBox="0 0 16 16">
          <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643z"/>
        </svg>
      </div>

      <div class="relative">
        <input 
          type="password" 
          placeholder="Contraseña" 
          class="w-full p-3 pl-10 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
          xmlns="http://www.w3.org/2000/svg" 
          fill="currentColor" 
          viewBox="0 0 16 16">
          <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
        </svg>
      </div>

      <button class="w-full p-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300">
        Iniciar sesión
      </button>

      <div class="flex justify-between text-sm text-gray-400">
        <button class="hover:underline">Olvidé mi contraseña</button>
        <button @click="$router.push('/registro')" class="hover:underline">Crear cuenta</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useRouter } from 'vue-router'
import { login } from '@/comunication_manager'
import { useCounterStore } from '@/stores/counter'
import { useQuasar, QSpinnerFacebook } from 'quasar'
import { onBeforeUnmount } from 'vue'

const $q = useQuasar() 
const router = useRouter()

const username = ref('')
const password = ref('')
const isPwd = ref(true)
const alert = ref(false)
const error = reactive({ errors: "" })
let timer

onBeforeUnmount(() => {
  if (timer !== void 0) {
    clearTimeout(timer)
    $q.loading.hide()
  }
})

async function aux_login() {
  const param = { username: username.value, password: password.value }

  $q.loading.show({
    spinner: QSpinnerFacebook, 
    spinnerColor: 'white',
    spinnerSize: 140,
    backgroundColor: 'black',
    message: 'Iniciando sesión...',
    messageColor: 'black',
  })
  try {
    const data = await login(param)

    $q.loading.hide()

    if (data.message == undefined) {
      const appStore = useCounterStore()
      appStore.setLoginInfo({
        loggedIn: true,
        username: data.user.username,
        email:data.user.email,
        avatar: data.user.avatar,
        nivel: data.user.nivel,
        token: data.token,
        id_user: data.user.id_user || data.user.id,
      })
      router.push('/jugar')
    } else {
      error.errors = data.message
      alert.value = true
    }
  } catch (err) {
    $q.loading.hide()
    console.error("Error durante el login:", err)
  }
}
</script>
