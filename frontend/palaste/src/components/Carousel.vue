<template>
  <div class="w-full h-screen relative overflow-hidden">
    <!-- Contenedor del carrusel -->
    <div
      class="hs-carousel relative w-full h-full"
      data-hs-carousel='{
        "loadingClasses": "opacity-0",
        "isAutoPlay": true,
        "autoPlayInterval": 8000,
        "transitionDuration": 700
      }'
    >
      <!-- Slides -->
      <div
        class="hs-carousel-body flex transition-transform duration-700"
        :style="carouselStyle"
      >
        <!-- Slide 1 -->
        <div class="hs-carousel-slide w-full h-screen flex-shrink-0 relative">
          <img
            src="@/assets/images/image1.jpg"
            class="w-full h-full object-cover"
            alt="Slide 1"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-6">
            <h2 class="text-5xl font-bold mb-4 font-playfair animate-fade-in">
              Todo lo que necesitas para soldar como un profesional 
            </h2>
            <p class="text-xl mb-6 max-w-2xl font-poppins animate-fade-in animate-delay-200">
              Encuentra los mejores materiales, cascos, herramientas y más. Calidad y durabilidad al mejor precio. ¡Haz realidad tus proyectos con nosotros!
            </p>
            <button class="bg-white text-black font-semibold py-2 px-6 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-poppins">
              Explora nuestra tienda ahora
            </button>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="hs-carousel-slide w-full h-screen flex-shrink-0 relative">
          <img
            src="@/assets/images/image2.jpg"
            class="w-full h-full object-cover"
            alt="Slide 2"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-6">
            <h2 class="text-5xl font-bold mb-4 font-playfair animate-fade-in">
              ¿Tienes una idea en mente? ¡Nosotros la hacemos realidad! 
            </h2>
            <p class="text-xl mb-6 max-w-2xl font-poppins animate-fade-in animate-delay-200">
              Diseña escaleras, mesas de metal, barandillas y más con la ayuda de nuestra IA. ¡Describe tu proyecto y obtén un diseño único en minutos!
            </p>
            <button class="bg-white text-black font-semibold py-2 px-6 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-poppins">
              Comienza tu diseño ahora
            </button>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="hs-carousel-slide w-full h-screen flex-shrink-0 relative">
          <img
            src="@/assets/images/image3.jpg"
            class="w-full h-full object-cover"
            alt="Slide 3"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-6">
            <h2 class="text-5xl font-bold mb-4 font-playfair animate-fade-in">
              Proyectos que inspiran, resultados que impresionan 
            </h2>
            <p class="text-xl mb-6 max-w-2xl font-poppins animate-fade-in animate-delay-200">
              Desde escaleras de exterior hasta muebles de metal personalizados, nuestros proyectos hablan por sí solos. ¡Descubre cómo transformamos ideas en realidades duraderas!
            </p>
            <button class="bg-white text-black font-semibold py-2 px-6 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-poppins">
              Ver proyectos destacados
            </button>
          </div>
        </div>
      </div>

      <!-- Botón Anterior -->
      <button
        @click="prevSlide"
        type="button"
        class="hs-carousel-prev absolute inset-y-0 start-0 inline-flex justify-center items-center w-12 h-full text-white bg-black/30 hover:bg-black/50"
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
        class="hs-carousel-next absolute inset-y-0 end-0 inline-flex justify-center items-center w-12 h-full text-white bg-black/30 hover:bg-black/50"
      >
        <span class="text-2xl">
          <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </span>
      </button>

      <!-- Paginación -->
      <div class="hs-carousel-pagination flex justify-center absolute bottom-8 start-0 end-0 space-x-2">
        <div
          v-for="(slide, index) in slides"
          :key="index"
          class="w-3 h-3 bg-white rounded-full cursor-pointer opacity-50 hover:opacity-100 transition-opacity"
          :class="{ 'opacity-100': currentIndex === index }"
          @click="goToSlide(index)"
        ></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const slides = [
  { image: '@/assets/images/image1.jpg' },
  { image: '@/assets/images/image2.jpg' },
  { image: '@/assets/images/image3.jpg' },
];

const currentIndex = ref(0);

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.length;
};

const prevSlide = () => {
  currentIndex.value = (currentIndex.value - 1 + slides.length) % slides.length;
};

const goToSlide = (index) => {
  currentIndex.value = index;
};

const carouselStyle = computed(() => {
  return {
    transform: `translateX(-${currentIndex.value * 100}%)`,
  };
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap');

.font-playfair {
  font-family: 'Playfair Display', serif;
}

.font-poppins {
  font-family: 'Poppins', sans-serif;
}

.hs-carousel-slide {
  transition: transform 0.7s ease-in-out;
}

.hs-carousel-body {
  will-change: transform;
}


.animate-fade-in {
  opacity: 0;
  animation: fadeIn 0.8s ease-in-out forwards;
}

.animate-delay-200 {
  animation-delay: 0.2s;
}

.animate-delay-400 {
  animation-delay: 0.4s;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>