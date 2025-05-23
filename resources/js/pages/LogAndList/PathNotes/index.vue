<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { type PathNote } from '@/types/LogAndList';
    import { Link , Head } from '@inertiajs/vue3';
    import { Button } from '@/components/ui/button';

    const pageTitle = 'Log&List';
    const pageSubTitle = 'PathNote';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: pageTitle,
            href: '/logandlist/metrics-data',
        },
         {
            title: pageSubTitle,
            href: '/logandlist/PathNote',
        },
       
    ];
    
    defineProps<{
        logAndListPathNotesList: PathNote[];
        }>();
</script>

<template>
    <Head :title="pageTitle" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <h1 class="text-xl font-semibold tracking-tight">Patch Notes for Log&List</h1>
                <Link :href="route('logandlist.path-notes-data.create')" 
                    class="ml-auto w-auto items-center inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                >
                    PathNote Create
                </Link>
            </div>
            
            <div class="grid auto-rows-min gap-4 grid-cols-1">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <table class="min-w-full table-auto border border-gray-300 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-center">ID</th>
                                <th class="border px-4 py-2 text-center">Title</th>
                                <th class="border px-4 py-2 text-center">created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pathnote in logAndListPathNotesList" :key="pathnote.id" class="hover:bg-gray-50">
                                <td class="border px-4 py-2 text-center">{{ pathnote.id }}</td>
                                <td class="border px-4 py-2 text-center">{{ pathnote.title }}</td>
                                <td class="border px-4 py-2 text-center">{{ pathnote.created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
