<template>
  <div class="w-full h-96 relative overflow-hidden">
    <!-- Contenedor del carrusel -->
    <div
      class="hs-carousel relative w-full h-full"
      data-hs-carousel='{
        "loadingClasses": "opacity-0",
        "isAutoPlay": true,
        "autoPlayInterval": 5000,
        "transitionDuration": 700
      }'
    >
      <!-- Slides -->
      <div
        class="hs-carousel-body flex transition-transform duration-700"
        :style="carouselStyle"
      >
        <!-- Slide 1: Máscaras/Cascos -->
        <div class="hs-carousel-slide w-full h-96 flex-shrink-0 relative">
          <img
            src="@/assets/images/mask.jpg"
            class="w-full h-full object-cover"
            alt="Máscaras y cascos para soldadores"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-6">
            <h2 class="text-5xl font-bold mb-6 font-ranchers animate-fade-in tracking-wide leading-tight">
              Protección Superior para Soldadores
            </h2>
            <p class="text-xl mb-8 max-w-2xl  animate-fade-in animate-delay-200 tracking-normal leading-relaxed">
              Descubre nuestras máscaras y cascos de alta calidad, diseñados para ofrecerte la máxima seguridad y comodidad en cada soldadura.
            </p>
            <button class="bg-white text-black font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-ranchers tracking-wide">
              Ver Máscaras y Cascos
            </button>
          </div>
        </div>

        <!-- Slide 2: Guantes -->
        <div class="hs-carousel-slide w-full h-96 flex-shrink-0 relative">
          <img
            src="@/assets/images/gloves.jpg"
            class="w-full h-full object-cover"
            alt="Guantes para soldadores"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-6">
            <h2 class="text-5xl font-bold mb-6 font-ranchers animate-fade-in tracking-wide leading-tight">
              Guantes Resistentes y Duraderos
            </h2>
            <p class="text-xl mb-8 max-w-2xl animate-fade-in animate-delay-200 tracking-normal leading-relaxed">
              Protege tus manos con nuestros guantes especializados para soldadores. Fabricados con materiales de alta resistencia para un rendimiento óptimo.
            </p>
            <button class="bg-white text-black font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-ranchers tracking-wide">
              Ver Guantes
            </button>
          </div>
        </div>

        <!-- Slide 3: Botas -->
        <div class="hs-carousel-slide w-full h-96 flex-shrink-0 relative">
          <img
            src="@/assets/images/boots.jpg"
            class="w-full h-full object-cover"
            alt="Botas para soldadores"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-6">
            <h2 class="text-5xl font-bold mb-6 font-ranchers animate-fade-in tracking-wide leading-tight">
              Botas Cómodas y Seguras
            </h2>
            <p class="text-xl mb-8 max-w-2xl animate-fade-in animate-delay-200 tracking-normal leading-relaxed">
              Nuestras botas están diseñadas para ofrecerte comodidad y protección en cada paso. Ideales para largas jornadas de trabajo.
            </p>
            <button class="bg-white text-black font-semibold py-3 px-8 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-ranchers tracking-wide">
              Ver Botas
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
      <div class="hs-carousel-pagination flex justify-center absolute bottom-4 start-0 end-0 space-x-2">
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
  { image: '@/assets/images/mask.jpg' },
  { image: '@/assets/images/gloves.jpg' },
  { image: '@/assets/images/boots.jpg' },
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
.font-ranchers {
  font-family: 'Ranchers', sans-serif;
}

/* Ajustes de tipografía */
.tracking-wide {
  letter-spacing: 0.05em; /* Espaciado entre letras */
}

.tracking-normal {
  letter-spacing: 0.025em; /* Espaciado entre letras para párrafos */
}

.leading-tight {
  line-height: 1.2; /* Espaciado entre líneas para títulos */
}

.leading-relaxed {
  line-height: 1.6; /* Espaciado entre líneas para párrafos */
}

.hs-carousel-slide {
  transition: transform 0.7s ease-in-out;
}

.hs-carousel-body {
  will-change: transform;
}

/* Animaciones personalizadas */
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