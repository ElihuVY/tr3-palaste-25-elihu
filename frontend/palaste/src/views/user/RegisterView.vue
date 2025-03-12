<template>
    <div class="contenedor">
      <div class="form">
        <formRegister/>
      </div>
    </div>
  </template>
  
  <script setup>
  import formRegister from '@/components/formRegister.vue';
  </script>
  
  <style scoped>
  .contenedor{
    background-color: rgb(15, 23, 42);
    min-height: 100vh;
    justify-content: center;
    align-items: flex-start;
    padding-top: 100px; 
  }
  .form{
    top: 10px;
  
  }
  </style>