<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
const props = defineProps({
    music: Object
})

const form = useForm({
    id: props.music.id,
    title: props.music.title,
    artist: props.music.artist,
    song: props.music.song,
    image: props.music.image
})

const id = props.music.id;

const updateMusic = (id) => {
    form.put(route('musicedit.update', { id: id }), {
        // onSuccess: () => {
        //     router.visit(route('musiclist'));
        // }
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto mt-4">
            <h1>Editar Música</h1>
           
                <form @submit.prevent="updateMusic(id)" enctype="multipart/form-data" class="m-2">
                    <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                    <input autofocus autocomplete="title" type="text" id="title" v-model="form.title" />

                    <label class="block text-sm font-medium text-gray-700" for="artist">Artist</label>
                    <input autocomplete="artist" type="text" id="artist" v-model="form.artist" />

                    <label class="block text-sm font-medium text-gray-700" for="song">Song</label>
                    <input autocomplete="song" type="file" id="song" @change="form.song = $event.target.files[0]" />

                    <label class="block text-sm font-medium text-gray-700" for="image">Image</label>
                    <input autocomplete="image" type="file" id="image" @change="form.image = $event.target.files[0]" />

                    <button @click="updateMusic(id)" type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Actualizar</button>
                </form>
            </div>
           
        
    </AuthenticatedLayout>
</template>