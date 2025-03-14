<script setup lang="ts">
import 'swiper/css';
import 'swiper/swiper-bundle.css';
import Carousel from '@/components/Carousel.vue';
import Header from '@/components/Header.vue';
import socialMedia from '@/components/socialMedia.vue';
</script>


<template>
  <div class="grid min-h-screen grid-rows-[auto_1fr] grid-cols-1">

    <Header />
    <Carousel/>

    <!-- Contenido principal con 3 secciones -->
    <main class="grid grid-rows-3 gap-8 p-8">
      <section class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Sobre Nosotros</h2>
        <p>Información sobre el negocio y su historia.</p>
      </section>

      <section class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Nuestros Servicios</h2>
        <p>Descripción de los servicios de soldadura ofrecidos.</p>
      </section>

      <section class="bg-gray-200 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold">Contacto</h2>
        <p>Formulario y datos de contacto para clientes.</p>
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
