<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    isAuthenticated: {
        type: Boolean,
        default: false,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
      <component :is="isAuthenticated ? AuthenticatedLayout : GuestLayout">


    
    <div class="bg-gray-50 min-h-screen flex flex-col">
      <!-- Navbar -->
      
  
      <!-- Hero Section -->
      <section class="flex-1 text-center py-20 px-4">
        <h2 class="text-4xl font-bold text-orange-700 mb-4">¡Encuentra pequeños trabajos cerca de ti!</h2>
        <p class="text-gray-600 mb-8">Gana dinero ayudando en tareas sencillas como pasear perros, hacer recados y más.</p>
        <Link :href="route('login')" class="bg-orange-700 hover:bg-orange-800 text-white font-bold py-3 px-6 rounded-full">
          Empezar ahora
        </Link>
      </section>
  
      <!-- Features Section -->
      <section class="py-16 bg-white">
        <div class="container mx-auto px-4 grid md:grid-cols-3 gap-8 text-center">
          <div class="p-6 shadow-md rounded-lg hover:shadow-xl transition">
            <h3 class="text-xl font-semibold text-orange-700 mb-2">Tareas fáciles</h3>
            <p class="text-gray-600">Ofertas que se adaptan a tu tiempo y energía.</p>
          </div>
          <div class="p-6 shadow-md rounded-lg hover:shadow-xl transition">
            <h3 class="text-xl font-semibold text-orange-700 mb-2">Gana dinero rápido</h3>
            <p class="text-gray-600">Cobra por trabajos sencillos y seguros cerca de tu casa.</p>
          </div>
          <div class="p-6 shadow-md rounded-lg hover:shadow-xl transition">
            <h3 class="text-xl font-semibold text-orange-700 mb-2">Todo para jóvenes</h3>
            <p class="text-gray-600">Plataforma pensada para menores de edad con autorización.</p>
          </div>
        </div>
      </section>
  
      <!-- Footer -->
      <footer class="bg-orange-700 p-4 mt-10">
        <div class="container mx-auto text-center text-white text-sm">
          © 2025 Little Jobs. Todos los derechos reservados.
        </div>
      </footer>
    </div>
    </component>
  </template>
  
 
  
  
  