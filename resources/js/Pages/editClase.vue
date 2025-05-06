<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
const props = defineProps({
    usuari: Object,
    courses: Array,
});

const form = useForm({
    id: '',
    name: '',
    course_id: '',
    phone: '',
});

onMounted(() => {
    // if (props.usuari) {
        form.id = props.usuari.id;
        form.name = props.usuari.name;
        form.course_id = props.usuari.course_id;
        form.phone = props.usuari.phone;
    // }
});

const save = () => {
    form.put(route('editclase.update', form.id));
}

</script>

<template>
   <div class="container mx-auto mt-4 bg-blue-100 m-2">
        <form @submit.prevent="save">
            <h1>Profesor</h1>
            <label class="block text-sm font-medium text-gray-700" for="name">Nom Usuari</label>
            <input class="border-2 border-gray-300 rounded-md p-2" v-model="form.name" type="text" id="name"
                name="name">

            <label class="block text-sm font-medium text-gray-700" for="phone">Tel Usuari</label>
            <input class="border-2 border-gray-300 rounded-md p-2" v-model="form.phone" type="tel" id="phone"
                name="phone">
            <div>
                <label class="block text-sm font-medium text-gray-700">Cursos</label>
                <select v-model="form.course_id" class="border-2 border-gray-300 rounded-md p-2">
                    <option value="">Seleccione un curso</option>
                    <option v-for="course in props.courses" :key="course.id" :value="course.id">
                        {{ course.name }}
                    </option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
        </form>

    </div>
</template>
