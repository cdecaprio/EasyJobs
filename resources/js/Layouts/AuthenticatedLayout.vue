<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const page = usePage();

</script>

<template>
    <!-- <div class="min-h-screen bg-red-600"> -->
    <!-- Navigation -->
    <nav class="bg-orange-700 p-4">
        <div class="container mx-auto flex justify-between items-center">
          <h1 class="text-white text-2xl font-bold">Little Jobs</h1>
          <ul class="flex space-x-6">
            <li><a href="#" class="text-white hover:text-gray-200">Inicio</a></li>
            <li><Link :href="route('ofertalist.index')" class="text-white hover:text-gray-200">Ofertas</Link></li>
           
            <li><Link :href="route('musiclist.list')" class="text-white hover:text-gray-200">Música</Link></li>
            <li><Link :href="route('clase.index')" class="text-white hover:text-gray-200">Clases</Link></li>
            
            <li><a href="#" class="text-white hover:text-gray-200">{{ page.props.auth.user.name }}</a></li>
            <Link :href="route('logout')" method="post" as="button" class="text-white hover:text-gray-200">Cerrar sesión</Link>
          </ul>
        </div>
      </nav>

    <!-- Page Content -->
    <main>
        <!-- Content of the page -->
        <slot />
    </main>
</template>
