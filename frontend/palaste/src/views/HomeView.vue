<script setup lang="ts">
import 'swiper/css';
import 'swiper/swiper-bundle.css';
import Carousel from '@/components/Carousel.vue';
import socialMedia from '@/components/socialMedia.vue';

import { ref } from 'vue';
const projectForm = ref({
  name: '',
  email: '',
  phone: '',
  projectType: '',
  description: '',
  budget: '',
  timeline: '',
  //files: null as FileList | null
})

const projectTypes = [
  'Escaleras de Exterior',
  'Barandillas',
  'Mesas',
  'Puertas',
  'Estructuras Metálicas',
  'Otros'
]

const handleProjectSubmit = () => {
  // Aquí iría la lógica para enviar el formulario
  console.log('Proyecto enviado:', projectForm.value)
}

</script>


<template>
  <div class="grid min-h-screen grid-rows-[auto_1fr] grid-cols-1">
    <Carousel/>

    <!-- Contenido principal con 3 secciones -->
    <main class="grid grid-rows-3 gap-8 p-8">
      <section class="py-20 bg-white">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="text-3xl font-bold mb-6">Sobre Nosotros</h2>
            <p class="text-gray-600 mb-4">
              En PALASTE, nos especializamos en la creación de soluciones metálicas personalizadas 
              de alta calidad. Con más de 15 años de experiencia en el sector, nuestro equipo de 
              expertos soldadores combina artesanía tradicional con tecnología moderna.
            </p>
            <p class="text-gray-600 mb-4">
              Nos enorgullecemos de ofrecer productos duraderos y servicios excepcionales, 
              desde pequeños proyectos decorativos hasta grandes estructuras industriales.
            </p>
            <div class="grid grid-cols-2 gap-4 mt-8">
              <div class="bg-gray-50 p-4 rounded-lg text-center">
                <h3 class="text-2xl font-bold text-primary-600">15+</h3>
                <p class="text-gray-600">Años de Experiencia</p>
              </div>
              <div class="bg-gray-50 p-4 rounded-lg text-center">
                <h3 class="text-2xl font-bold text-primary-600">500+</h3>
                <p class="text-gray-600">Proyectos Completados</p>
              </div>
            </div>
          </div>
          <div class="relative">
            <img
              src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1"
              alt="Taller PALASTE"
              class="rounded-lg shadow-xl"
            />
            <div class="absolute -bottom-6 -left-6 bg-primary-600 text-white p-6 rounded-lg">
              <p class="text-lg font-semibold">Calidad y Precisión</p>
              <p>En cada proyecto que realizamos</p>
            </div>
          </div>
        </div>
      </div>
    </section>




      <section class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Nuestros Servicios</h2>
        <p>Descripción de los servicios de soldadura ofrecidos.</p>
      </section>

      <!-- Request Project Section -->
    <section class="py-20 bg-white">
      <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
          <h2 class="text-3xl font-bold text-center mb-12">Solicita tu Proyecto</h2>
          <form @submit.prevent="handleProjectSubmit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input
                  type="text"
                  id="name"
                  v-model="projectForm.name"
                  required
                  class="input-field"
                />
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input
                  type="email"
                  id="email"
                  v-model="projectForm.email"
                  required
                  class="input-field"
                />
              </div>
            </div>

            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
              <input
                type="tel"
                id="phone"
                v-model="projectForm.phone"
                class="input-field"
              />
            </div>

            <div>
              <label for="projectType" class="block text-sm font-medium text-gray-700 mb-1">
                Tipo de Proyecto
              </label>
              <select
                id="projectType"
                v-model="projectForm.projectType"
                required
                class="input-field"
              >
                <option value="">Selecciona un tipo</option>
                <option v-for="type in projectTypes" :key="type" :value="type">
                  {{ type }}
                </option>
              </select>
            </div>

            <div>
              <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                Descripción del Proyecto
              </label>
              <textarea
                id="description"
                v-model="projectForm.description"
                rows="4"
                required
                class="input-field"
                placeholder="Describe tu proyecto, incluyendo medidas, materiales preferidos y cualquier detalle relevante..."
              ></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">
                  Presupuesto Estimado
                </label>
                <input
                  type="text"
                  id="budget"
                  v-model="projectForm.budget"
                  class="input-field"
                  placeholder="€"
                />
              </div>
              <div>
                <label for="timeline" class="block text-sm font-medium text-gray-700 mb-1">
                  Plazo Deseado
                </label>
                <input
                  type="text"
                  id="timeline"
                  v-model="projectForm.timeline"
                  class="input-field"
                  placeholder="ej: 2 semanas, 1 mes..."
                />
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">
                Adjuntar Imágenes o Planos (opcional)
              </label>
              <input
                type="file"
                multiple
                accept="image/*,.pdf"
                class="input-field"
              />
              <p class="text-sm text-gray-500 mt-1">
                Puedes adjuntar imágenes de referencia o planos en formato PDF
              </p>
            </div>

            <div>
              <button type="submit" class="btn btn-primary w-full">
                Solicitar Presupuesto
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>




       <!-- Contact Section -->
    <section class="py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
          <div>
            <h2 class="text-3xl font-bold mb-6">Contacta con Nosotros</h2>
            <p class="text-gray-600 mb-8">
              Estamos aquí para ayudarte. Contáctanos para cualquier consulta sobre 
              nuestros servicios o productos.
            </p>
            <div class="space-y-4">
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <div class="ml-3">
                  <h3 class="text-lg font-medium text-gray-900">Dirección</h3>
                  <p class="text-gray-600">Calle Principal 123, 28001 Madrid</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                </div>
                <div class="ml-3">
                  <h3 class="text-lg font-medium text-gray-900">Teléfono</h3>
                  <p class="text-gray-600">+34 912 345 678</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div class="ml-3">
                  <h3 class="text-lg font-medium text-gray-900">Email</h3>
                  <p class="text-gray-600">info@palaste.com</p>
                </div>
              </div>
            </div>
            <div class="mt-8">
              <h3 class="text-lg font-medium text-gray-900 mb-4">Horario</h3>
              <div class="space-y-2">
                <p class="text-gray-600">Lunes a Viernes: 9:00 - 18:00</p>
                <p class="text-gray-600">Sábados: 9:00 - 14:00</p>
                <p class="text-gray-600">Domingos: Cerrado</p>
              </div>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow-lg p-6">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12147.354030289095!2d-3.7037929302246094!3d40.41677527934679!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid%2C%20Spain!5e0!3m2!1sen!2s!4v1623456789012!5m2!1sen!2s"
              width="100%"
              height="450"
              style="border:0;"
              loading="lazy"
              class="rounded-lg"
            ></iframe>
          </div>
        </div>
      </div>
    </section>



    </main>
  </div>

  <footer class="flex justify-center items-center py-6 bg-gray-800 text-white">
      <socialMedia />
    </footer>

</template>
<style scoped>


.router-link-active {
  @apply font-bold text-primary;
}

.contenedor {
  display: grid;
  grid-template-rows: auto 1fr;
  min-height: 100vh;
}

.parallax-bg {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: -1;
  background-size: cover;
  background-position: center;
}

header {
  width: 100%;
  padding: 15px;
  display: flex;
  justify-content: flex-end;
}
</style>
