<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head } from '@inertiajs/vue3';
    import GoogleAnalyticsDimensionsChart from '@/components/googleanalytics/DimensionsChart.vue';
    const pageTitle = 'Dashboard';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: pageTitle,
            href: '/dashboard-dimensions-data',
        }
    ];
    const props = defineProps<{
        analyticsData: object;
        }>();
</script>

<template>
    <Head :title="pageTitle" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1 class="text-4xl font-black tracking-tight">{{ pageTitle }}</h1>
            <h2 class="text-xl font-semibold tracking-tight">This is the dimension data of major projects</h2>
            <div class="grid auto-rows-min gap-4 grid-cols-1 md:grid-cols-2">
                <div 
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                    v-for="(projectData, key) in props.analyticsData"
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
