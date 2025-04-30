<script setup>
import AuthenticatedLayout from '../Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    music: Array
})
</script>

<template>
    <AuthenticatedLayout>
        <div class="screen-h-screen">
            <div class="container mx-auto mt-4">
                <div class="container mx-auto mt-4">
                    <h1>Music List</h1>
                </div>

            </div>

            <div class="container mx-auto mt-4 mb-4">
                <div v-for="music in props.music" :key="music.id">
                    <div class="container mx-auto mt-4 mb-4">
                        <h1>{{ music.title }}</h1>
                        <img :src="`/storage/${music.image}`" alt="music image" class="w-10 h-10 rounded-md">
                        <audio :src="`/storage/${music.song}`" controls></audio>
                        <p>{{ music.artist }}</p>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>