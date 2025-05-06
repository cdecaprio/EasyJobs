<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    usuaris: Array,
    courses: Array,
    
});

console.log(props);
console.log("props.usuaris", props.usuaris);

const getCourseName = (courseId) => {
    return props.courses.find(c => c.id === courseId)?.name || 'Sin curso';
}

const form = useForm({
    id: '',
    name: '',
    course_id: '',
    phone: '',


});

const save = () => {
    form.post(route('clase.save'));
}

</script>

<template>
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Formulario -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form @submit.prevent="save" class="space-y-4">
                    <h1 class="text-2xl font-bold mb-4">Profesor</h1>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700" for="name">Nom Usuari</label>
                        <input 
                            aria-label="Nom Usuari" 
                            class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            v-model="form.name" 
                            type="text" 
                            id="name"
                            name="name">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700" for="phone">Tel Usuari</label>
                        <input 
                            aria-label="Tel Usuari" 
                            class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            v-model="form.phone" 
                            type="tel" 
                            id="phone"
                            name="phone">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Cursos</label>
                        <select 
                            aria-label="Cursos" 
                            v-model="form.course_id" 
                            class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccione un curso</option>
                            <option v-for="course in props.courses" :key="course.id" :value="course.id">
                                {{ course.name }}
                            </option>
                        </select>
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-[#2b72e6] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                        Guardar
                    </button>
                </form>
            </div>

            <!-- Lista de Alumnos -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold mb-4">Alumnes</h1>
                <ul class="space-y-4">
                    <li v-for="usuari in props.usuaris" 
                        :key="usuari.id"
                        class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg space-y-2 sm:space-y-0">
                        <div class="space-y-1">
                            <p class="text-xl font-bold text-blue-500">{{ usuari.name }}</p>
                            <p class="text-gray-600">{{ usuari.phone }}</p>
                            <p class="text-gray-600">{{ getCourseName(usuari.course_id) }}</p>
                        </div>
                        <a 
                            :href="route('editclase.edit', usuari.id)"
                            class="inline-block bg-[#2b72e6] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-center">
                            Editar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>