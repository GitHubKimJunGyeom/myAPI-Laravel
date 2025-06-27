<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { type Comments } from '@/types/LogAndList';
    import { Head } from '@inertiajs/vue3';
    const pageTitle = 'Log&List';
    const pageSubTitle = 'Comments';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: pageTitle,
            href: '/logandlist/metrics-data',
        },
         {
            title: pageSubTitle,
            href: '/logandlist/comments',
        },
       
    ];
    
    defineProps<{
        logAndListCommentsList: Comments[];
        }>();
</script>

<template>
    <Head :title="pageTitle" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1 class="text-xl font-semibold tracking-tight">This is the current status of Log&List latest comment list</h1>
            <div class="grid auto-rows-min gap-4 grid-cols-1">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <table class="min-w-full table-auto border border-gray-300 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-center">Comment ID</th>
                                <th class="border px-4 py-2 text-center">User ID</th>
                                <th class="border px-4 py-2 text-center">Nickname</th>
                                <th class="border px-4 py-2 text-center">Content</th>
                                <th class="border px-4 py-2 text-center">Page ID</th>
                                <th class="border px-4 py-2 text-center">Parent ID</th>
                                <th class="border px-4 py-2 text-center">created at</th>
                                <th class="border px-4 py-2 text-center">updated at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="comment in logAndListCommentsList" :key="comment.id" class="hover:bg-gray-50">
                                <td class="border px-4 py-2 text-center">{{ comment.id }}</td>
                                <td class="border px-4 py-2 text-center">{{ comment.user_id ?? 'nothing'}}</td>
                                <td class="border px-4 py-2 text-center">{{ comment.nickname }}</td>
                                <td class="border px-4 py-2 text-center">{{ comment.content }}</td>
                                <td class="border px-4 py-2 text-center">{{ comment.page_id }}</td>
                                <td class="border px-4 py-2 text-center">{{ comment.parent_id ?? 'nothing' }}</td>
                                <td class="border px-4 py-2 text-center">{{ comment.created_at }}</td>
                                <td class="border px-4 py-2 text-center">{{ comment.updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
