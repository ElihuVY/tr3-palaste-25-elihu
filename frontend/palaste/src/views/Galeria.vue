<template>
  <div class="gallery-container">
    <h1 class="gallery-title">Galerie</h1>
    
    <div class="gallery-grid" ref="galleryGrid">
      <div 
        v-for="(image, index) in displayedImages" 
        :key="index" 
        class="gallery-item"
        :class="{ 'is-tall': image.isTall }"
        @click="openImageModal(image)">
        <img 
          :src="image.url" 
          :alt="image.title" 
          class="gallery-image"
          @load="handleImageLoad"
          loading="lazy">
        <div class="image-overlay">
          <h3>{{ image.title }}</h3>
          <p>{{ image.description }}</p>
        </div>
      </div>
      
      <div v-if="isLoading" class="loading-indicator">
        <div class="spinner"></div>
        <p>Chargement de plus d'images...</p>
      </div>
    </div>
    
    <!-- Modal para vista ampliada de la imagen -->
    <div v-if="selectedImage" class="image-modal" @click.self="closeImageModal">
      <div class="modal-content">
        <button class="close-button" @click="closeImageModal">&times;</button>
        <img :src="selectedImage.url" :alt="selectedImage.title" class="modal-image">
        <div class="modal-info">
          <h2>{{ selectedImage.title }}</h2>
          <p>{{ selectedImage.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GalleryView',
  data() {
    return {
      images: [],
      displayedImages: [],
      page: 1,
      isLoading: false,
      selectedImage: null,
      imagesLoaded: 0,
      observer: null
    }
  },
  mounted() {
    this.loadInitialImages();
    
    // Configurar Intersection Observer para detección de scroll
    const options = {
      rootMargin: '0px 0px 200px 0px',
      threshold: 0.1
    };
    
    this.observer = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting && !this.isLoading) {
        this.loadMoreImages();
      }
    }, options);
    
    // Observar el último elemento para cargar más cuando sea visible
    const observerTarget = document.createElement('div');
    observerTarget.classList.add('observer-target');
    this.$refs.galleryGrid.appendChild(observerTarget);
    this.observer.observe(observerTarget);
    
    // Escuchar eventos de redimensionamiento de ventana
    window.addEventListener('resize', this.handleResize);
  },
  beforeDestroy() {
    this.observer.disconnect();
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    // Generar datos de ejemplo para la galería
    generateSampleImages(count, startIndex = 0) {
      const images = [];
      for (let i = 0; i < count; i++) {
        const index = startIndex + i;
        const isTall = Math.random() > 0.7; // 30% de las imágenes serán más altas
        
        images.push({
          id: index,
          url: `/api/placeholder/${isTall ? 400 : 500}/${isTall ? 600 : 400}`,
          title: `Proyecto ${index + 1}`,
          description: `Descripción del proyecto ${index + 1}. Un breve texto sobre este trabajo.`,
          isTall
        });
      }
      return images;
    },
    
    loadInitialImages() {
      this.isLoading = true;
      
      // Simular carga de datos desde API
      setTimeout(() => {
        this.images = this.generateSampleImages(12);
        this.displayedImages = [...this.images];
        this.isLoading = false;
      }, 800);
    },
    
    loadMoreImages() {
      if (this.isLoading) return;
      
      this.isLoading = true;
      this.page++;
      
      // Simular carga de datos adicionales
      setTimeout(() => {
        const newImages = this.generateSampleImages(8, this.images.length);
        this.images = [...this.images, ...newImages];
        this.displayedImages = [...this.images];
        this.isLoading = false;
      }, 1200);
    },
    
    handleImageLoad() {
      this.imagesLoaded++;
      // Podríamos implementar alguna animación cuando las imágenes estén cargadas
    },
    
    handleResize() {
      // Podríamos ajustar el diseño si es necesario al cambiar el tamaño de la ventana
    },
    
    openImageModal(image) {
      this.selectedImage = image;
      document.body.style.overflow = 'hidden'; // Evitar scroll en el fondo
    },
    
    closeImageModal() {
      this.selectedImage = null;
      document.body.style.overflow = ''; // Restaurar scroll
    }
  }
}
</script>

<style scoped>
.gallery-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.gallery-title {
  text-align: center;
  margin-bottom: 30px;
  color: #333;
  font-size: 32px;
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-auto-rows: 250px;
  grid-gap: 20px;
  grid-auto-flow: dense;
}

.gallery-item {
  position: relative;
  overflow: hidden;
  border-radius: 8px;
  box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.gallery-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.gallery-item.is-tall {
  grid-row: span 2;
}

.gallery-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.gallery-item:hover .gallery-image {
  transform: scale(1.05);
}

.image-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
  color: white;
  padding: 20px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.gallery-item:hover .image-overlay {
  opacity: 1;
}

.image-overlay h3 {
  margin: 0 0 5px 0;
  font-size: 18px;
}

.image-overlay p {
  margin: 0;
  font-size: 14px;
}

.loading-indicator {
  grid-column: 1 / -1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 30px 0;
}

.spinner {
  width: 40px;
  height: 40px;
  border: 4px solid rgba(0, 0, 0, 0.1);
  border-left-color: #3498db;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* Estilos para el modal */
.image-modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.85);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-content {
  position: relative;
  max-width: 90%;
  max-height: 90%;
  background-color: white;
  border-radius: 8px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 10px;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
}

.modal-image {
  max-width: 100%;
  max-height: 70vh;
  object-fit: contain;
}

.modal-info {
  padding: 20px;
  background-color: white;
}

.modal-info h2 {
  margin-top: 0;
  color: #333;
}

/* Responsive */
@media (max-width: 768px) {
  .gallery-grid {
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  }
}

@media (max-width: 480px) {
  .gallery-grid {
    grid-template-columns: 1fr;
    grid-auto-rows: auto;
  }
  
  .gallery-item.is-tall {
    grid-row: span 1;
  }
}

.observer-target {
  grid-column: 1 / -1;
  height: 10px;
}
</style>