<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { ref } from 'vue';
import MainLayout from '@/Layouts/MainLayout.vue';


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

// function handleImageError() {
//     document.getElementById('screenshot-container')?.classList.add('!hidden');
//     document.getElementById('docs-card')?.classList.add('!row-span-1');
//     document.getElementById('docs-card-content')?.classList.add('!flex-row');
//     document.getElementById('background')?.classList.add('!hidden');
// }

const index = ref(0);

const textos = [
  'Benvingut al nostre projecte!',
  'Explora les funcionalitats disponibles.',
  'Recorda desar els teus progressos.',
  'Gracies per visitar-nos!'
];

const next = () => {
  index.value = (index.value + 1) % textos.length;
};

const prev = () => {
  index.value = (index.value - 1 + textos.length) % textos.length;
};
</script>

<template>
    <MainLayout>  


    
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
  



    <section class="relative min-h-screen py-2 px-2 md:px-4 sm:py-10 bg-white">
<div class="w-full max-w-xl mx-auto p-4">
  <div class="relative">
    <p class="text-center">{{ textos[index] }}</p>

    <div class="absolute top-1/2 left-0 transform -translate-y-1/2">
      <button @click="prev" class="bg-white px-2 py-1 rounded shadow">←</button>
    </div>

    <div class="absolute top-1/2 right-0 transform -translate-y-1/2">
      <button @click="next" class="bg-white px-2 py-1 rounded shadow">→</button>
    </div>
  </div>

  <div class="flex justify-center gap-2 mt-2">
    <span
      v-for="(texto, i) in textos"
      :key="i"
      class="w-2 h-2 rounded-full"
      :class="i === index ? 'bg-black' : 'bg-gray-400'"
    ></span>
  </div>
</div>
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
  </MainLayout>
  </template>
  
 
  
  
  