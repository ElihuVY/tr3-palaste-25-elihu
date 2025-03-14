<script setup>
import Carousel from '@/components/CarouselShop.vue';
import ProductItem from '@/components/ProductItem.vue'; // Importa el componente ProductItem

// Datos de productos aleatorios (simulados)
const products = [
  {
    id: 1,
    name: "Nike Air MX Super 2500 - Red",
    image: "https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60",
    price: 449,
    oldPrice: 699,
    discount: 39,
    rating: 5,
  },
  {
    id: 2,
    name: "Adidas Ultraboost 21",
    image: "https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60",
    price: 180,
    oldPrice: 220,
    discount: 18,
    rating: 4,
  },
  {
    id: 3,
    name: "Puma RS-X",
    image: "https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60",
    price: 120,
    oldPrice: 150,
    discount: 20,
    rating: 4.5,
  },
  {
    id: 4,
    name: "Reebok Classic Leather",
    image: "https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8c25lYWtlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60",
    price: 90,
    oldPrice: 120,
    discount: 25,
    rating: 4.2,
  },
  {
    id: 5,
    name: "Nike Air Max 270",
    image: "https://images.unsplash.com/photo-1543508282-6319a3e2621f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fHNuZWFrZXJ8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60",
    price: 150,
    oldPrice: 200,
    discount: 25,
    rating: 4.7,
  },
  {
    id: 6,
    name: "New Balance 574",
    image: "https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTJ8fHNuZWFrZXJ8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60",
    price: 110,
    oldPrice: 130,
    discount: 15,
    rating: 4.3,
  },
  {
    id: 7,
    name: "Converse Chuck Taylor",
    image: "https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTN8fHNuZWFrZXJ8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60",
    price: 60,
    oldPrice: 80,
    discount: 25,
    rating: 4.0,
  },
  {
    id: 8,
    name: "Vans Old Skool",
    image: "https://images.unsplash.com/photo-1562183241-b937e95585d5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTR8fHNuZWFrZXJ8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60",
    price: 70,
    oldPrice: 90,
    discount: 22,
    rating: 4.1,
  },
];

// Función para manejar la adición al carrito
const handleAddToCart = (product) => {
  console.log("Producto añadido al carrito:", product);
};
</script>

<template>
  <div class="contenedor">
    <h1>PALASTE SHOP</h1>

    <!-- Carrusel -->
    <Carousel />

    <!-- Listado de productos -->
    <div class="product-list">
      <ProductItem
        v-for="product in products"
        :key="product.id"
        :product="product"
        @add-to-cart="handleAddToCart"
      />
    </div>
  </div>
</template>

<style scoped>
h1 {
  text-align: center;
  font-family: 'Ranchers', sans-serif;
  font-size: 50px;
}

.contenedor {
  max-width: 1900px; /* Limita el ancho máximo del contenedor */
  margin: 0 auto; /* Centra el contenedor */
}

.product-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 4 productos por fila */
  gap: 20px;
  margin-top: 20px;
}

/* Asegura que no haya scroll horizontal */
body {
  overflow-x: hidden;
}
</style>