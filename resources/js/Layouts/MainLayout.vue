<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3"
import CustomButton from "../Components/CustomButton.vue";

const coockiesAccepted = ref(false);

if(localStorage.getItem("cookies") === "true"){
    coockiesAccepted.value = true;
}

const acceptCookies = () => {
    coockiesAccepted.value = true;
    localStorage.setItem("cookies", "true");
}
</script>

<template>
    <header class="min-h-[98px] bg-red-800 flex items-center justify-between px-2">
        <Link href="/" class="flex justify-start w-1/5 items-center hover:border-b-2 border-white">
            <div class="min-w-[50px] min-h-[50px] bg-gray-300"></div>
            <h1 class="text-xl md:text-4xl text-white font-bold ms-2">Anuncis</h1>
        </Link>
        <div class="w-1/2 lg:w-1/3 flex justify-end">
            <CustomButton link="/ads" class="!bg-red-600 hover:!bg-white mx-8 lg:mx-4">Anuncis</CustomButton>
            <CustomButton link="/dashboard" class="!bg-red-600 hover:!bg-white">Entra</CustomButton>
        </div>
    </header>
    <main class="p-2">
        <slot />
    </main>
    <div v-if="!coockiesAccepted" class="fixed bottom-0 left-0 right-0 bg-red-800 text-white p-4">
        <p>Utilizamos cookies para mejorar la experiencia de usuario. Si continúas navegando, consideramos que aceptas su uso.</p>
        <CustomButton @click="acceptCookies">Aceptar</CustomButton>
    </div>
</template>