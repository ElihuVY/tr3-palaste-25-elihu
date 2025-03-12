//LIBRERIA: PRELINE
<template>
    <div class="w-full bg-white rounded-lg shadow-md dark:bg-neutral-800">
      <div 
        data-hs-carousel='{
          "loadingClasses": "opacity-0",
          "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500"
        }' 
        class="relative"
      >
        <div class="hs-carousel relative overflow-hidden w-full h-[500px] bg-white rounded-lg">
          <!-- Contenedor del carrusel -->
          <div 
            class="hs-carousel-body flex transition-transform duration-700"
            :style="carouselStyle"
          >
            <div class="hs-carousel-slide w-full flex-shrink-0 relative" v-for="(slide, index) in slides" :key="index">
              <img :src="slide.image" class="w-full h-[500px] object-cover rounded-lg" alt="Slide image">
              <div class="absolute inset-0 flex items-center justify-center bg-black/50 text-white text-2xl font-semibold">
                {{ slide.text }}
              </div>
            </div>
          </div>
        </div>
  
        <!-- Botón Anterior -->
        <button
          @click="prevSlide"
          type="button"
          class="hs-carousel-prev absolute inset-y-0 start-0 inline-flex justify-center items-center w-11.5 h-full text-white bg-black/30 hover:bg-black/50 rounded-s-lg"
        >
          <span class="text-2xl">
            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m15 18-6-6 6-6"></path>
            </svg>
          </span>
        </button>
  
        <!-- Botón Siguiente -->
        <button
          @click="nextSlide"
          type="button"
          class="hs-carousel-next absolute inset-y-0 end-0 inline-flex justify-center items-center w-11.5 h-full text-white bg-black/30 hover:bg-black/50 rounded-e-lg"
        >
          <span class="text-2xl">
            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m9 18 6-6-6-6"></path>
            </svg>
          </span>
        </button>
  
        <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2"></div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';  // Importamos `computed` aquí
  import image1 from '@/assets/images/image1.jpg';
  import image2 from '@/assets/images/image2.jpg';
  import image3 from '@/assets/images/image3.jpg';
  
  const slides = [
    { image: image1, text: 'Primera imagen' },
    { image: image2, text: 'Segunda imagen' },
    { image: image3, text: 'Tercera imagen' }
  ];
  
  // Control de los slides
  const currentIndex = ref(0);
  
  // Funciones para navegar entre los slides
  const nextSlide = () => {
    currentIndex.value = (currentIndex.value + 1) % slides.length;
  };
  
  const prevSlide = () => {
    currentIndex.value = (currentIndex.value - 1 + slides.length) % slides.length;
  };
  
  // Estilo para el carrusel (para el movimiento de los slides)
  const carouselStyle = computed(() => {
    return {
      transform: `translateX(-${currentIndex.value * 100}%)`
    };
  });
  </script>
  
  <style scoped>
  .hs-carousel-slide {
    transition: transform 0.7s ease-in-out;
  }
  .hs-carousel-body {
  will-change: transform;
}

  </style>
  