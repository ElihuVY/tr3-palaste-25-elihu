<template>
  <div class="text-center">
    <div class="text-3xl font-bold text-white mb-2">
      <button @click="$router.push('/home')" class="hover:underline">PALASTE</button>
    </div>
    <h2 class="text-lg text-gray-400 mb-6">Regístrate</h2>

    <form class="space-y-4" @submit.prevent="registrar">
      <div class="relative">
        <input v-model="name" type="text" placeholder="Usuario"
          class="w-full p-3 pl-10 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          required />
      </div>

      <div class="relative">
        <input v-model="email" type="email" placeholder="Correo electrónico"
          class="w-full p-3 pl-10 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          required />
      </div>

      <div class="relative">
        <input v-model="password" :type="isPwd ? 'password' : 'text'" placeholder="Contraseña"
          class="w-full p-3 pl-10 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          required minlength="8" />
      </div>

      <div class="relative">
        <input v-model="password_confirmation" :type="isPwd ? 'password' : 'text'" placeholder="Confirmar contraseña"
          class="w-full p-3 pl-10 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          required minlength="8" />
      </div>

      <p v-if="password !== password_confirmation && password_confirmation" class="text-red-500 text-sm">
        Las contraseñas no coinciden
      </p>

      <p v-if="errorMessage" class="text-red-500 text-sm mt-2">{{ errorMessage }}</p>

      <button type="submit" :disabled="password !== password_confirmation || authStore.cargando"
        class="w-full p-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-300 disabled:bg-blue-400 disabled:cursor-not-allowed">
        {{ authStore.cargando ? 'Cargando...' : 'Registrarse' }}
      </button>

      <div class="flex justify-between text-sm text-gray-400">
        <button @click="$router.push('/iniciar-sesion')" class="hover:underline">
          ¿Ya tienes una cuenta? Inicia sesión
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { register } from '@/comunication_manager';
import { useAuthStore } from '@/stores/authStore';
import { useRouter } from 'vue-router';

const router = useRouter();
const authStore = useAuthStore();
const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const isPwd = ref(true);
const errorMessage = ref('');

async function registrar() {
  console.log("Formulario enviado");
  if (password.value !== password_confirmation.value) {
    errorMessage.value = 'Las contraseñas no coinciden.';
    return;
  }

  try {
    authStore.cargando = true;
    const data = await register({
      
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    });
    console.log("await");

    if (!data.errors) {
      authStore.setLoginInfo({
        loggedIn: true,
        name: data.user.name,
        email: data.user.email,
        token: data.token,
      });
      router.push('/home');
    } else {
      errorMessage.value = data.errors.join(', ');
    }
  } catch (err) {
    errorMessage.value = "Error en el registro, intenta nuevamente.";
  } finally {
    authStore.cargando = false;
  }
}
</script>
