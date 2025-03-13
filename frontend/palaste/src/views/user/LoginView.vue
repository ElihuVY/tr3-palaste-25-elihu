<template>
  <div class="contenedor">
    <div class="grid min-h-screen grid-rows-[auto_1fr] grid-cols-1">
      <Header />
    <div class="form">
      <formLogin/>
    </div>
  </div>
</div>
</template>

<script setup>
import formLogin from '@/components/formLogin.vue';
import Header from '@/components/Header.vue';

</script>

<style scoped>
.contenedor{
  background-color: rgb(47, 69, 119);
  min-height: 100vh;
  justify-content: center;
  align-items: flex-start;
}
.form{
  top: 10px;

}
header {
  width: 100%;
  padding: 5px;
  display: flex;
  justify-content: flex-end;
}
</style>