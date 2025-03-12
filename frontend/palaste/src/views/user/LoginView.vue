<template>
  <div class="contenedor">
    <div class="form">
      <formLogin/>
    </div>
  </div>
</template>

<script setup>
import formLogin from '@/components/formLogin.vue';
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