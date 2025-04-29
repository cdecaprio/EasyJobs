<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const isAuthenticated = computed(() => usePage().props.auth.user);
const props = defineProps({
    offers: Array
});
const showModal = ref(false);
const createOffer = ref({
    title: '',
    description: '',
    salary: '',
    image: '',
    age: ''
}); 

console.log(props.offers);



</script>
<template>
    <component :is="isAuthenticated ? AuthenticatedLayout : GuestLayout">
       <div class="container mx-auto mt-4">
        <div class="container mx-auto mt-4">
        <button @click="showModal = true" type="button" class="bg-orange-700 text-white px-4 py-2 rounded-md hover:bg-orange-800 transition-colors">
            Crear oferta
        </button>
       </div>
       </div>

       <!-- Modal -->
       <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Crear oferta</h3>
                <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="space-y-4" @submit.prevent="createOffer">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"></textarea>
                </div>
                <div>
                    
                </div>
                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700">Salario</label>
                    <input type="number" id="salary" name="salary" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                    <input type="file" id="image" name="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                </div>
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Edad</label>
                    <input type="number" id="age" name="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                </div>

                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" @click="showModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-orange-700 rounded-md hover:bg-orange-800">
                        Crear
                    </button>
                </div>
            </form>
        </div>
       </div>
        <div class="container mx-auto">
            
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-lg font-bold">Oferta 1</h2>
                    <p class="text-gray-600">Descripción de la oferta 1</p>
                </div>
            </div>
        </div>
        
        
    </component>
    
</template>