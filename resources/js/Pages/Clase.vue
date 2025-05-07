<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, watch, computed } from 'vue';
import Modal from '@/Components/Modal.vue';
const props = defineProps({
    usuaris: Array,
    courses: Array,
    usuari: Object,
});

// Estado reactivo local para los usuarios
let usuarios = ref(props.usuaris);


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
    view();
}

//axios delete
const deleteUser = (id) => {
    axios.delete(route('clasedelete.delete', { id: id })).then(response => {
        view();
    })
}

//fetch view
const view = () => {
    fetch(route('clase.view'))
        .then(response => response.json())
        .then(data => {
            usuarios.value = data;
        })
    // axios.get(route('clase.view')).then(response => {
    //     usuarios.value = response.data;

    // })
}

// fetch('ruta del controlador)
//   .then(response => {
//     if (!response.ok) {
//       throw new Error('Error en la solicitud: ' + response.status);
//     }
//     return response.json(); // Convertir la respuesta a JSON
//   })
//   .then(data => {
//     console.log('Usuarios:', data); // Mostrar los datos en consola
//   })
//   .catch(error => {
//     console.error('Ocurrió un error:', error);
//   });

// ejemplo

// const deleteUser = (id) => {
//     fetch(route('clase.delete', { id: id }), {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             // Agrega aquí cualquier header necesario, como CSRF token si aplica
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         usuarios.value = data;
//         console.log('response.data delete', data);

//         // Luego hacemos la petición GET
//         fetch(route('clase.view'))
//             .then(response => response.json())
//             .then(data => {
//                 usuarios.value = data;
//                 console.log('response.data view', data);
//             })
//             .catch(error => console.error('Error en fetch clase.view:', error));
//     })
//     .catch(error => console.error('Error en fetch clase.delete:', error));
// }

const modalVisible = ref(false)
const selectedUser = ref(null)

const form2 = useForm({
    name: '',
    phone: '',
    course_id: '',
});

const openEditModal = (user) => {
    selectedUser.value = user;
    form2.name = user.name;
    form2.phone = user.phone;
    form2.course_id = user.course_id;
    modalVisible.value = true;
}

const updateUser = (id) => {
    axios.put(route('claseupdate.update', { id: id }), form2)
        .then(response => {
            modalVisible.value = false;
            view();
        })
        ;
}

const searchquery = ref('');

const userToSearch = computed(() => {
    if (!searchquery.value) return usuarios.value;

    return usuarios.value.filter(user =>
        user.name.toLowerCase().includes(searchquery.value.toLowerCase()) ||
        user.phone.toString().includes(searchquery.value) ||
        getCourseName(user.course_id).toLowerCase().includes(searchquery.value.toLowerCase())
    );
});

// const searchUser = () => {
//     // No necesitamos hacer una llamada al servidor ya que el filtrado se hace en el cliente
//     // El computed property userToSearch se actualizará automáticamente
// }


</script>

<template>
    <GuestLayout>
        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Formulario -->
                <div class="bg-white p-6 rounded-lg shadow-lg">

                    <label class="block text-sm font-medium text-gray-700" for="searchUser">Buscar</label>
                    <input aria-label="searchUser" id="searchUser" type="text" v-model="searchquery"
                        class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Buscar por nombre, teléfono o curso">

                    <form @submit.prevent="save" class="space-y-4">
                        <h1 class="text-2xl font-bold mb-4">Profesor</h1>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700" for="name">Nom Usuari</label>
                            <input aria-label="Nom Usuari"
                                class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                v-model="form.name" type="text" id="name" name="name">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700" for="phone">Tel Usuari</label>
                            <input aria-label="Tel Usuari"
                                class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                v-model="form.phone" type="number" id="phone" name="phone" maxlength="9">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Cursos</label>
                            <select aria-label="Cursos" v-model="form.course_id"
                                class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Seleccione un curso</option>
                                <option v-for="course in props.courses" :key="course.id" :value="course.id">
                                    {{ course.name }}
                                </option>
                            </select>
                        </div>

                        <button aria-label="save" @click="view" type="submit"
                            class="w-full bg-[#2b72e6] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                            Guardar
                        </button>
                    </form>
                </div>

                <!-- Lista de Alumnos -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h1 class="text-2xl font-bold mb-4">Alumnes</h1>
                    <ul class="space-y-4">
                        <li v-for="usuari in userToSearch" :key="usuari.id"
                            class="flex flex-col sm:flex-row sm:items-center justify-between p-4 bg-gray-50 rounded-lg space-y-2 sm:space-y-0">
                            <div class="space-y-1">
                                <p class="text-xl font-bold text-blue-500">{{ usuari.name }}</p>
                                <p class="text-gray-600">{{ usuari.phone }}</p>
                                <p class="text-gray-600">{{ getCourseName(usuari.course_id) }}</p>
                            </div>
                            <button aria-label="edit" id="edit" @click="openEditModal(usuari)"
                                class="inline-block bg-[#2b72e6] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-center">
                                Editar
                            </button>
                            <!-- :href="route('editclase.edit', usuari.id)" -->
                            <button aria-label="delete" @click="deleteUser(usuari.id)"
                                class="inline-block bg-[#2b72e6] text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors text-center">
                                Eliminar
                            </button>
                        </li>
                    </ul>
                </div>
                <Modal :show="modalVisible" @close="modalVisible = false">
                    <template #title>Editar Usuario</template>
                    <div class="container mx-auto mt-4">
                        <form @submit.prevent="updateUser(selectedUser.id)" class="m-2 space-y-4">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700" for="edit-name">Nombre</label>
                                <input class="w-full border-2 border-gray-300 rounded-md p-2" v-model="form2.name"
                                    type="text" id="edit-name" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700" for="edit-phone">Teléfono</label>
                                <input class="w-full border-2 border-gray-300 rounded-md p-2" v-model="form2.phone"
                                    type="tel" id="edit-phone" required>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Curso</label>
                                <select v-model="form2.course_id"
                                    class="w-full border-2 border-gray-300 rounded-md p-2">
                                    <option value="">Seleccione un curso</option>
                                    <option v-for="course in props.courses" :key="course.id" :value="course.id">
                                        {{ course.name }}
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-end p-4">
                        <button @click="modalVisible = false"
                            class="m-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Cerrar
                        </button>
                        <button @click="updateUser(selectedUser.id)"
                            class="m-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Actualizar
                        </button>
                    </div>
                </Modal>
            </div>
        </div>

    </GuestLayout>
    <footer class="bg-gray-800 text-white py-4">
        <p class="text-center">
            &copy; 2025 Little Jobs. Todos los derechos reservados.
        </p>
    </footer>
</template>