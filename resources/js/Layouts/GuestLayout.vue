<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};
</script>

<template>
    <!-- <div class="min-h-screen bg-red-600"> -->
    <!-- Navigation -->
    <nav class="bg-orange-700 p-4">
        <div class="container mx-auto flex justify-between items-center">
          <h1 class="text-white text-2xl font-bold">Little Jobs</h1>
          
          <!-- Botón hamburguesa para móvil -->
          <button @click="toggleMenu" class="md:hidden text-white">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path v-if="!isMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                  <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
          </button>

          <!-- Menú de navegación -->
          <ul :class="[
              'md:flex md:space-x-6',
              isMenuOpen ? 'absolute top-16 left-0 right-0 bg-orange-700 p-4 space-y-4' : 'hidden'
          ]">
            <li><a href="#" class="block text-white hover:text-gray-200">Inicio</a></li>
            <li><a href="#" class="block text-white hover:text-gray-200">¿Cómo Funciona?</a></li>
            <li><Link :href="route('musiclist.list')" class="block text-white hover:text-gray-200">Música</Link></li>
            <li><Link :href="route('clase.list')" class="block text-white hover:text-gray-200">Clase</Link></li>
            <li><a href="#" class="block text-white hover:text-gray-200">Contacto</a></li>
            <li><Link :href="route('login')" class="block text-white hover:text-gray-200">Iniciar sesión</Link></li>
          </ul>
        </div>
      </nav>

    <!-- Page Content -->
    <main>
        <!-- Content of the page -->
        <slot />
    </main>
    
</template>
