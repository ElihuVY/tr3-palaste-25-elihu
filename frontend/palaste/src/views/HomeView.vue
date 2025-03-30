<script setup lang="ts">
import 'swiper/css';
import 'swiper/swiper-bundle.css';
import Carousel from '@/components/Carousel.vue';
import socialMedia from '@/components/socialMedia.vue';

import { ref } from 'vue';
</script>

<template>
  <div class="grid min-h-screen grid-rows-[auto_1fr] grid-cols-1">
    <Carousel/>

    <main class="grid grid-rows-3 gap-8 p-8">
      <section class="py-20 bg-white">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="text-3xl font-bold mb-6">Sobre Nosotros</h2>
            <p class="text-gray-600 mb-4">
              En PALASTE, somos una innovadora empresa de soldadura que combina talento joven con una 
              rica experiencia en el oficio. Aunque hemos iniciado recientemente nuestro camino como 
              empresa, nuestro equipo está formado por profesionales con más de 15 años de trayectoria 
              en el arte de la soldadura.
            </p>
            <p class="text-gray-600 mb-4">
              Fusionamos técnicas tradicionales de soldadura con métodos contemporáneos, 
              permitiéndonos ofrecer soluciones metálicas de precisión que destacan tanto por 
              su funcionalidad como por su estética. Cada pieza que creamos refleja nuestra 
              pasión por el detalle y nuestro compromiso con la excelencia.
            </p>
            <div class="grid grid-cols-2 gap-4 mt-8">
              <div class="bg-gray-50 p-4 rounded-lg text-center">
                <h3 class="text-2xl font-bold text-primary-600">15+</h3>
                <p class="text-gray-600">Años de Experiencia</p>
              </div>
              <div class="bg-gray-50 p-4 rounded-lg text-center">
                <h3 class="text-2xl font-bold text-primary-600">100%</h3>
                <p class="text-gray-600">Satisfacción del Cliente</p>
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
              <p class="text-lg font-semibold">Artesanía e Innovación</p>
              <p>La perfecta combinación en cada proyecto</p>
            </div>
          </div>
        </div>
      </div>
    </section>

      <section class="py-16 bg-gray-100 rounded-lg shadow-md">
        <div class="container mx-auto px-4">
          <h2 class="text-3xl font-bold mb-8 text-center">Nuestros Servicios</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md transition-transform hover:scale-105">
              <div class="text-primary-600 mb-4">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Tienda Especializada</h3>
              <p class="text-gray-600">
                Ofrecemos una amplia gama de productos y herramientas para soldadores profesionales y aficionados. 
                Desde equipos de última generación hasta consumibles de alta calidad, encontrarás todo lo necesario 
                para tus proyectos de soldadura.
              </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md transition-transform hover:scale-105">
              <div class="text-primary-600 mb-4">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Proyectos Personalizados</h3>
              <p class="text-gray-600">
                Materializamos tus ideas en metal. Desde elegantes barandillas de diseño hasta robustas escaleras 
                a medida, mobiliario exclusivo o elementos decorativos únicos. Cada proyecto se adapta perfectamente 
                a tus necesidades y estilo.
              </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md transition-transform hover:scale-105">
              <div class="text-primary-600 mb-4">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Servicios Profesionales</h3>
              <p class="text-gray-600">
                Brindamos servicios de soldadura especializados para industrias y particulares. Nuestro equipo 
                trabaja con diversos materiales y técnicas, garantizando resultados de alta calidad y durabilidad 
                en cada trabajo que realizamos.
              </p>
            </div>
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
                  <p class="text-gray-600">Lyon, Francia</p>
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
                  <p class="text-gray-600">+33 768237722</p>
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
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44530.930663686366!2d4.801203086081061!3d45.75800923068287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4ea516ae88797%3A0x408ab2ae4bb21f0!2sLyon%2C%20France!5e0!3m2!1sen!2s!4v1623456789012!5m2!1sen!2s"
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
section{
  max-height: 450px; 
  overflow-y: auto; 
  padding: 20px;
  background-color: #f8f8f8;
  border-radius: 10px;
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