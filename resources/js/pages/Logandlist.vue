<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import GoogleAnalyticsMetricsChart from '@/components/googleanalytics/MetricsChart.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Log&List',
        href: '/logandlist',
    }
];

const project = defineProps<{
    logAndListMetricsData: Record<string, object>
}>();
console.log(project);
</script>

<template>
    <Head title="Log&list" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 grid-cols-1">
                <div 
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                    v-for="(data, date) in project.logAndListMetricsData"
                    :key="date"
                    >
                    <GoogleAnalyticsMetricsChart
                        :chartData="data"
                        :targetDate="date"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
