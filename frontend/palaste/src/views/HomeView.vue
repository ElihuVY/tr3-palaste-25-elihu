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

    <main class="grid gap-4 md:gap-8 p-4 md:p-8">
      <!-- À Propos Section -->
      <section class="py-8 md:py-20 bg-white">
        <div class="container mx-auto px-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12 items-center">
            <div>
              <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6">À Propos de Nous</h2>
              <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4">
                Chez PALASTE, nous sommes une entreprise de soudure innovante qui combine jeunes talents et 
                riche expérience du métier. Bien que nous ayons récemment débuté notre parcours en tant 
                qu'entreprise, notre équipe est composée de professionnels avec plus de 15 ans d'expérience 
                dans l'art de la soudure.
              </p>
              <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4">
                Nous fusionnons les techniques traditionnelles de soudure avec des méthodes contemporaines, 
                nous permettant d'offrir des solutions métalliques de précision qui se distinguent tant par 
                leur fonctionnalité que par leur esthétique. Chaque pièce que nous créons reflète notre 
                passion du détail et notre engagement envers l'excellence.
              </p>
              <div class="grid grid-cols-2 gap-3 md:gap-4 mt-6 md:mt-8">
                <div class="bg-gray-50 p-3 md:p-4 rounded-lg text-center">
                  <h3 class="text-xl md:text-2xl font-bold text-primary-600">15+</h3>
                  <p class="text-sm md:text-base text-gray-600">Années d'Expérience</p>
                </div>
                <div class="bg-gray-50 p-3 md:p-4 rounded-lg text-center">
                  <h3 class="text-xl md:text-2xl font-bold text-primary-600">100%</h3>
                  <p class="text-sm md:text-base text-gray-600">Satisfaction Client</p>
                </div>
              </div>
            </div>
            <div class="relative mt-6 md:mt-0">
              <img
                src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1"
                alt="Atelier PALASTE"
                class="rounded-lg shadow-xl w-full h-auto"
              />
              <div class="absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 bg-primary-600 text-white p-4 md:p-6 rounded-lg text-sm md:text-base">
                <p class="text-lg font-semibold">Artisanat et Innovation</p>
                <p>La combinaison parfaite dans chaque projet</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Services Section -->
      <section class="py-8 md:py-16 bg-gray-100 rounded-lg shadow-md">
        <div class="container mx-auto px-4">
          <h2 class="text-2xl md:text-3xl font-bold mb-6 md:mb-8 text-center">Nos Services</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md transition-transform hover:scale-105">
              <div class="text-primary-600 mb-4">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Boutique Spécialisée</h3>
              <p class="text-gray-600">
                Nous proposons une large gamme de produits et d'outils pour les soudeurs professionnels et amateurs. 
                Des équipements de dernière génération aux consommables de haute qualité, vous trouverez tout le 
                nécessaire pour vos projets de soudure.
              </p>
            </div>
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md transition-transform hover:scale-105">
              <div class="text-primary-600 mb-4">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Projets Personnalisés</h3>
              <p class="text-gray-600">
                Nous donnons vie à vos idées en métal. Des élégantes rampes design aux robustes escaliers 
                sur mesure, du mobilier exclusif aux éléments décoratifs uniques. Chaque projet est parfaitement 
                adapté à vos besoins et votre style.
              </p>
            </div>
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-md transition-transform hover:scale-105">
              <div class="text-primary-600 mb-4">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Services Professionnels</h3>
              <p class="text-gray-600">
                Nous fournissons des services de soudure spécialisés pour les industries et les particuliers. 
                Notre équipe travaille avec divers matériaux et techniques, garantissant des résultats de haute 
                qualité et durables dans chaque travail que nous réalisons.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Contact Section -->
      <section class="py-8 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-12">
            <div>
              <h2 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6">Contactez-Nous</h2>
              <p class="text-sm md:text-base text-gray-600 mb-6 md:mb-8">
                Nous sommes là pour vous aider. Contactez-nous pour toute question sur 
                nos services ou produits.
              </p>
              <div class="space-y-4">
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <svg class="h-5 w-5 md:h-6 md:w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                  </div>
                  <div class="ml-3">
                    <h3 class="text-sm md:text-lg font-medium text-gray-900">Adresse</h3>
                    <p class="text-sm md:text-base text-gray-600">Lyon, France</p>
                  </div>
                </div>
                <!-- <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <svg class="h-5 w-5 md:h-6 md:w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                  </div>
                  <div class="ml-3">
                    <h3 class="text-sm md:text-lg font-medium text-gray-900">Téléphone</h3>
                    <p class="text-sm md:text-base text-gray-600">+33 768237722</p>
                  </div>
                </div> -->
                <div class="flex items-start">
                  <div class="flex-shrink-0">
                    <svg class="h-5 w-5 md:h-6 md:w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                  </div>
                  <div class="ml-3">
                    <h3 class="text-sm md:text-lg font-medium text-gray-900">Email</h3>
                    <p class="text-sm md:text-base text-gray-600">info@palaste.com</p>
                  </div>
                </div>
              </div>
              <!-- <div class="mt-6 md:mt-8">
                <h3 class="text-sm md:text-lg font-medium text-gray-900 mb-2 md:mb-4">Horaires d'Ouverture</h3>
                <div class="space-y-1 md:space-y-2">
                  <p class="text-sm md:text-base text-gray-600">Lundi à Vendredi: 9h00 - 18h00</p>
                  <p class="text-sm md:text-base text-gray-600">Samedi: 9h00 - 14h00</p>
                  <p class="text-sm md:text-base text-gray-600">Dimanche: Fermé</p>
                </div>
              </div> -->
            </div>
            <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44530.930663686366!2d4.801203086081061!3d45.75800923068287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4ea516ae88797%3A0x408ab2ae4bb21f0!2sLyon%2C%20France!5e0!3m2!1sen!2s!4v1623456789012!5m2!1sen!2s"
                width="100%"
                height="300"
                style="border:0;"
                loading="lazy"
                class="rounded-lg"
              ></iframe>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="flex justify-center items-center py-4 md:py-6 bg-gray-800 text-white">
      <socialMedia />
    </footer>
  </div>
</template>

<style scoped>
.router-link-active {
  @apply font-bold text-primary;
}

section {
  max-height: none;
  overflow-y: visible;
  padding: 16px;
  @apply md:py-5 md:px-5; /* Cambiado a clases válidas */
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