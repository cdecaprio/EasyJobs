<script setup>
import axios from 'axios';
import AuthenticatedLayout from '../Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

 const props = defineProps({
    music: Array
 })

const form = useForm({
    title: '',
    artist: '',
    song: '',
    image: ''
})

// const form2 = useForm({
//     id: props.music.id,
//     title: props.music.title,
//     artist: props.music.artist,
//     song: props.music.song,
//     image: props.music.image
// })

function save() {
    form.post(route('musiclistsave.save'), {
        onSuccess: () => {
            console.log('success');
        }
    });
}



const music = ref(props.music);

const deleteMusic = (id) => {
    axios.post(route('musiclist.delete', { id: id })).then(response => {
        props.music = response.data;

        axios.get(route('musiclist.view')).then(response => {
            console.log(response.data);

            music.value = response.data;

        })


    })

}

const createMusic = () => {
    axios.get(route('musiclist.view')).then(response => {
        console.log(response.data);

        music.value = response.data;
    })
}

// const modalVisible = ref(false)
// const selectedMusic = ref(null)

// const openEditModal = (music) => {
//     selectedMusic.value = music;
//     form2.title = music.title;
//     form2.artist = music.artist;
//     modalVisible.value = true;
// }



// const randomMusic = () => {
//     axios.get(route('musicrandom.random')).then(response => {
//         console.log(response.data);
//         music.value = response.data;
//         music.value = response.data;

//         const audioElement = document.getElementById('randomMusic');
//         audioElement.play();
//     })
// }
</script>

<template>
    <AuthenticatedLayout>


        <div class="container mx-auto mt-4 bg-red-100">
            <form @submit.prevent="save" enctype="multipart/form-data">
                <div class="container mx-auto mt-4">
                    <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                    <input autocomplete="title" type="text" id="title" v-model="form.title" />


                    <label class="block text-sm font-medium text-gray-700" for="artist">Artist</label>
                    <input autocomplete="artist" type="text" id="artist" v-model="form.artist" />


                    <label class="block text-sm font-medium text-gray-700" for="song">Song</label>
                    <input autocomplete="song" type="file" id="song" @change="form.song = $event.target.files[0]" />

                    <label class="block text-sm font-medium text-gray-700" for="image">Image</label>
                    <input autocomplete="image" type="file" id="image" @change="form.image = $event.target.files[0]" />
                </div>
                <button @click="createMusic" type="submit"
                    class="bg-green-500 text-white px-4 py-2 mt-4 rounded-md">Save</button>
            </form>
        </div>
        <div class="min-h-screen px-4">
            

            <div class="container mx-auto mt-4 mb-4">
                <div v-for="music in music" :key="music.id">
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 border-2 border-gray-300 rounded-md p-2 mb-2">
                        <div>
                            <h2 class="text-xl font-bold">{{ music.title }}</h2>
                        </div>
                        <div>
                            <p class="text-gray-500 font-semibold">{{ music.artist }}</p>
                        </div>
                        <div>
                            <img :src="`/storage/${music.image}`" alt="music image"
                                class="w-20 h-20 object-cover rounded-md">
                        </div>
                        <div>
                            <audio :src="`/storage/${music.song}`" controls class="w-full"></audio>
                        </div>
                        <div class="flex justify-start sm:justify-end space-x-2">
                            <button @click="deleteMusic(music.id)"
                                class="bg-red-500 text-white px-3 py-2 rounded-md">Delete</button>
                        
                            <Link :href="`/musicedit/${music.id}`" 
                                class="bg-blue-500 text-white px-3 py-2 rounded-md">
                                Edit
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        <!-- <Modal :show="modalVisible" @close="modalVisible = false">
            <template #title>Editar Música</template>
            <div class="container mx-auto mt-4">
                <form @submit.prevent="updateMusic(selectedMusic.id)" enctype="multipart/form-data" class="m-2">
                    <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                    <input autofocus autocomplete="title" type="text" id="title" v-model="form2.title" />

                    <label class="block text-sm font-medium text-gray-700" for="artist">Artist</label>
                    <input autocomplete="artist" type="text" id="artist" v-model="form2.artist" />

                    <label class="block text-sm font-medium text-gray-700" for="song">Song</label>
                    <input autocomplete="song" type="file" id="song" @change="form2.song = $event.target.files[0]" />

                    <label class="block text-sm font-medium text-gray-700" for="image">Image</label>
                    <input autocomplete="image" type="file" id="image" @change="form2.image = $event.target.files[0]" />
                </form>
            </div>
            <div class="flex justify-end p-4">
                <button @click="modalVisible = false" class="m-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Cerrar
                </button>
                <button @click="updateMusic(selectedMusic.id)" class="m-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Actualizar
                </button>
            </div>
        </Modal> -->


    </AuthenticatedLayout>
</template>