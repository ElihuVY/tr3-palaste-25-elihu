<template>
  <div class="w-full h-[80vh] relative overflow-hidden">
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
        <div class="hs-carousel-slide w-full h-[100vh] flex-shrink-0 relative">
          <img
            src="@/assets/images/image1.webp"
            class="w-full h-full object-cover"
            alt="Slide 1"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-4 md:p-6">
            <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold mb-2 md:mb-4 font-poppins animate-fade-in">
              Tout ce dont vous avez besoin pour souder comme un professionnel
            </h2>
            <p class="text-sm md:text-lg lg:text-xl mb-4 md:mb-6 max-w-2xl font-poppins animate-fade-in animate-delay-200 px-4 md:px-0">
              Trouvez les meilleurs matériaux, casques, outils et plus encore. Qualité et durabilité au meilleur prix.
            </p>
            <router-link to="/tienda" class="bg-white text-black font-semibold py-2 px-4 md:px-6 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-poppins text-sm md:text-base">
              Explorez notre boutique
            </router-link>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="hs-carousel-slide w-full h-[100vh] flex-shrink-0 relative">
          <img
            src="@/assets/images/image2.webp"
            class="w-full h-full object-cover"
            alt="Slide 2"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-4 md:p-6">
            <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold mb-2 md:mb-4 font-poppins animate-fade-in">
              Vous avez une idée en tête ? Nous la rendons réelle !
            </h2>
            <p class="text-sm md:text-lg lg:text-xl mb-4 md:mb-6 max-w-2xl font-poppins animate-fade-in animate-delay-200 px-4 md:px-0">
              Concevez des escaliers, des tables métalliques, des rampes et plus avec l'aide de notre IA. Décrivez votre projet et obtenez un design unique en quelques minutes !
            </p>
            <router-link to="/presupuesto" class="bg-white text-black font-semibold py-2 px-4 md:px-6 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-poppins text-sm md:text-base">
              Commencez votre design maintenant
            </router-link>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="hs-carousel-slide w-full h-[100vh] flex-shrink-0 relative">
          <img
            src="@/assets/images/image3.webp"
            class="w-full h-full object-cover"
            alt="Slide 3"
          />
          <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center text-center text-white p-4 md:p-6">
            <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold mb-2 md:mb-4 font-poppins animate-fade-in">
              Des projets qui inspirent, des résultats qui impressionnent
            </h2>
            <p class="text-sm md:text-lg lg:text-xl mb-4 md:mb-6 max-w-2xl font-poppins animate-fade-in animate-delay-200 px-4 md:px-0">
              Des escaliers extérieurs aux meubles métalliques personnalisés, nos projets parlent d'eux-mêmes. Découvrez comment nous transformons les idées en réalités durables !
            </p>
            <router-link to="/tienda" class="bg-white text-black font-semibold py-2 px-4 md:px-6 rounded-lg hover:bg-gray-100 transition-all animate-fade-in animate-delay-400 font-poppins text-sm md:text-base">
              Voir les projets phares
            </router-link>
          </div>
        </div>
      </div>

      <!-- Botón Anterior -->
      <button
        @click="prevSlide"
        type="button"
        class="hs-carousel-prev absolute inset-y-0 start-0 inline-flex justify-center items-center w-8 md:w-12 h-full text-white bg-black/30 hover:bg-black/50"
      >
        <span class="text-xl md:text-2xl">
          <svg class="shrink-0 size-4 md:size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6"></path>
          </svg>
        </span>
      </button>

      <!-- Botón Siguiente -->
      <button
        @click="nextSlide"
        type="button"
        class="hs-carousel-next absolute inset-y-0 end-0 inline-flex justify-center items-center w-8 md:w-12 h-full text-white bg-black/30 hover:bg-black/50"
      >
        <span class="text-xl md:text-2xl">
          <svg class="shrink-0 size-4 md:size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6"></path>
          </svg>
        </span>
      </button>

      <!-- Paginación -->
      <div class="hs-carousel-pagination flex justify-center absolute bottom-4 md:bottom-8 start-0 end-0 space-x-2">
        <div
          v-for="(slide, index) in slides"
          :key="index"
          class="w-2 h-2 md:w-3 md:h-3 bg-white rounded-full cursor-pointer opacity-50 hover:opacity-100 transition-opacity"
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
  { image: '@/assets/images/image1.webp' },
  { image: '@/assets/images/image2.webp' },
  { image: '@/assets/images/image3.webp' },
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
  font-family: 'Poppins', sans-serif;
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

/* Agregar estas nuevas reglas */
@media (max-width: 768px) {
  .animate-fade-in {
    animation-duration: 0.6s;
  }
}
</style>