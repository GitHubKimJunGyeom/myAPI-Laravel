<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen w-full items-center justify-center bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]">
        <main class="flex flex-col items-center justify-center gap-8">
            <img 
                src="@/public/assets/img/png/MyApiAguimanChan.png" 
                alt="myAPI"
                class="cursor-pointer max-w-[300px] object-contain"
                @click="$inertia.visit(route('dashboard.dimensions-data.index'))"
            />
            <div class="flex flex-col items-center justify-center gap-4 text-center">
                <h1 class="text-3xl font-bold">Welcome to myAPI</h1>
                <p class="text-sm text-[#19140080] dark:text-[#EDEDEC80]">
                    This is a simple API built with Laravel and Inertia.js.<br />
                    You can check detailed information by clicking on the image.
                </p>
            </div>
        </main>
    </div>
</template>


