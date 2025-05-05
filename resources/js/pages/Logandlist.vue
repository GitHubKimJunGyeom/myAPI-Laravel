<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
// import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Log&List',
        href: '/logandlist',
    }
];

defineProps({
    analyticsData:{
        type: Array,
    },
});

</script>

<template>
    <Head title="Log&list" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div v-for="(dayData, date) in analyticsData" :key="date" class="mb-6">
                    <h2 class="text-lg font-bold mb-2">날짜: {{ date }}</h2>
                    <table class="table-auto border w-full text-sm">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-2 py-1">페이지 경로</th>
                            <th class="border px-2 py-1">국가</th>
                            <th class="border px-2 py-1">활성 사용자</th>
                            <th class="border px-2 py-1">신규 사용자</th>
                            <th class="border px-2 py-1">조회수</th>
                            <th class="border px-2 py-1">카테고리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(row, index) in dayData.entries" :key="index">
                            <td class="border px-2 py-1">{{ row.fullPageUrl }}</td>
                            <td class="border px-2 py-1">{{ row.country }}</td>
                            <td class="border px-2 py-1">{{ row.activeUsers }}</td>
                            <td class="border px-2 py-1">{{ row.newUsers }}</td>
                            <td class="border px-2 py-1">{{ row.screenPageViews }}</td>
                            <td class="border px-2 py-1">{{ row.deviceCategory }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
