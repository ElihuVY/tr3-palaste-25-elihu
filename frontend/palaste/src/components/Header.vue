//LIBRERIA: Shadcn-vue
<template>
    <header class="bg-slate-900 p-4 rounded-lg shadow-md flex gap-4">
      <NavigationMenu>
        <NavigationMenuList class="bg-slate-900 p-4 rounded-lg shadow-md flex gap-4">
          <NavigationMenuItem>
            <RouterLink to="/home"
              class="block p-3 rounded-md transition hover:bg-accent hover:text-accent-foreground text-white">
              <div class="text-sm font-medium">Inicio</div>
            </RouterLink>
          </NavigationMenuItem>
  
          <NavigationMenuItem>
            <RouterLink to="/tienda"
              class="block p-3 rounded-md transition hover:bg-accent hover:text-accent-foreground text-white">
              <div class="text-sm font-medium">Tienda</div>
            </RouterLink>
          </NavigationMenuItem>
  
          <NavigationMenuItem>
            <RouterLink to="/presupuesto"
              class="block p-3 rounded-md transition hover:bg-accent hover:text-accent-foreground text-white">
              <div class="text-sm font-medium">Presupuesto</div>
            </RouterLink>
          </NavigationMenuItem>
  
          <NavigationMenuItem>
            <NavigationMenuTrigger class="text-white">Usuario</NavigationMenuTrigger>
            <NavigationMenuContent>
              <ul class="grid gap-2 p-1 w-[100px] md:w-[330px]">
                <li>
                  <NavigationMenuLink as-child>
                    <RouterLink to="/registro" class="block p-3 rounded-md transition hover:bg-accent text-white">
                      <div class="text-sm font-medium">Registro</div>
                      <p class="text-sm text-muted-foreground">Crea una cuenta nueva.</p>
                    </RouterLink>
                  </NavigationMenuLink>
                </li>
                <li>
                  <NavigationMenuLink as-child>
                    <RouterLink to="/iniciar-sesion" class="block p-3 rounded-md transition hover:bg-accent text-white">
                      <div class="text-sm font-medium">Iniciar Sesión</div>
                      <p class="text-sm text-muted-foreground">Accede con tu cuenta.</p>
                    </RouterLink>
                  </NavigationMenuLink>
                </li>
                <li>
                  <NavigationMenuLink as-child>
                    <RouterLink to="/profile" class="block p-3 rounded-md transition hover:bg-accent text-white">
                      <div class="text-sm font-medium">Perfil</div>
                      <p class="text-sm text-muted-foreground">Información de tu cuenta.</p>
                    </RouterLink>
                  </NavigationMenuLink>
                </li>
              </ul>
            </NavigationMenuContent>
          </NavigationMenuItem>
        </NavigationMenuList>
      </NavigationMenu>
    </header>
  </template>
  
  <script setup>
  // Si necesitas importar algún componente global o usar alguna lógica en este componente, lo haces aquí.

  import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
} from '@/components/ui/navigation-menu';
import { RouterLink } from 'vue-router';
  </script>
  
  <style scoped>
  /* Puedes agregar estilos específicos para este componente aquí si lo necesitas */
  </style>
  