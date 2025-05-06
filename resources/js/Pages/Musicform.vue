<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
const form = useForm({
    title: '',
    artist: '',
    song: '',
    image: ''
})

function save(){
    form.post(route('musicform.save'), {
        onSuccess: () => {
            console.log('success');
        }
    });
}




</script>

<template>
    <AuthenticatedLayout>
        <div class="container mx-auto mt-4">
            
                <Link class="bg-orange-700 text-white px-4 py-2 rounded-md hover:bg-orange-800 transition-colors" :href="route('musiclist.list')">Music List</Link>
            </div>
        
        <div class="container mx-auto mt-4 bg-red-100">
        <form @submit.prevent="save" enctype="multipart/form-data">
            <div class="container mx-auto mt-4">
            <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
            <input  autocomplete="title" type="text" id="title" v-model="form.title" />
            
            
            <label class="block text-sm font-medium text-gray-700" for="artist">Artist</label>
            <input  autocomplete="artist" type="text" id="artist" v-model="form.artist" />
            
           
            <label class="block text-sm font-medium text-gray-700" for="song">Song</label>
            <input  autocomplete="song" type="file" id="song" @change="form.song = $event.target.files[0]" />
          
            <label class="block text-sm font-medium text-gray-700" for="image">Image</label>
            <input  autocomplete="image" type="file" id="image" @change="form.image = $event.target.files[0]" />
            </div>
            <button type="submit">Save</button>
        </form>
        </div>
  
    </AuthenticatedLayout>
</template>
