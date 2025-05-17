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
      </div>
    </div>
    
    <!-- Modal para vista ampliada de la imagen -->
    <div v-if="selectedImage" class="image-modal" @click.self="closeImageModal">
      <div class="modal-content">
        <button class="close-button" @click="closeImageModal">&times;</button>
        <img :src="selectedImage.url" :alt="selectedImage.title" class="modal-image">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'GalleryView',
  data() {
    return {
      displayedImages: [],
      isLoading: false,
      selectedImage: null,
      imagesLoaded: 0
    }
  },
  mounted() {
    this.loadImages();
  },
  methods: {
    generateUniqueImages(count) {
      const images = [];
      const totalImagesAvailable = 26; // Limitamos a 26 imágenes únicas
      
      for (let i = 0; i < count && i < totalImagesAvailable; i++) {
        const index = i + 1;
        const isTall = Math.random() > 0.7;
        
        images.push({
          id: i,
          url: `/image${index}.webp`,
          title: `Imagen ${index}`,
          isTall
        });
      }
      return images;
    },
    
    loadImages() {
      this.isLoading = true;
      
      setTimeout(() => {
        this.displayedImages = this.generateUniqueImages(26);
        this.isLoading = false;
      }, 800);
    },
    
    handleImageLoad() {
      this.imagesLoaded++;
    },
    
    openImageModal(image) {
      this.selectedImage = image;
      document.body.style.overflow = 'hidden';
    },
    
    closeImageModal() {
      this.selectedImage = null;
      document.body.style.overflow = '';
    }
  }
}
</script>

<style scoped>
.gallery-container {
  width: 100%; /* Asegura que el contenedor ocupe todo el ancho de la pantalla */
  max-width: 100%;
  margin: 0 auto;
  padding: 20px;
  overflow-y: auto; /* Permite el desplazamiento vertical */
}
.gallery-title {
  text-align: center;
  margin-bottom: 30px;
  color: #3d4b74; /* Darker blue gray color */
  font-size: 38px;
  font-weight: 900; /* Increased font weight */
  text-transform: uppercase;
  letter-spacing: 2px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
  padding: 15px 0;

  font-family: 'Arial', sans-serif;
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
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.gallery-item:hover .gallery-image {
  transform: scale(1.05);
  opacity: 0.9;
}

.image-overlay {
  display: none; /* Ocultamos completamente el overlay con la información */
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
  display: none; /* Ocultamos la información en el modal */
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