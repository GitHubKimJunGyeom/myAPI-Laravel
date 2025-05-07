<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import GoogleAnalyticsDimensionsChart from '@/components/googleanalytics/DimensionsChart.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    }
];

const projectList = defineProps<{
  kjkPortfolioDimensionsData: Record<string, number>
  logAndListDimensionsData: Record<string, number>
}>();
</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div 
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                    v-for="(projectData, key) in projectList"
                    :key="key"
                >
                    <GoogleAnalyticsDimensionsChart
                        :chartData="projectData"
                        :projectName="key"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
