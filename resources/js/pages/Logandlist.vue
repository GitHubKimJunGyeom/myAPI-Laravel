<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head } from '@inertiajs/vue3';
    import GoogleAnalyticsMetricsChart from '@/components/googleanalytics/MetricsChart.vue';
    const pageTitle = 'Log&List';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: pageTitle,
            href: '/logandlist-metrics-data',
        }
    ];
    const project = defineProps<{
        logAndListMetricsData: Record<string, object>
    }>();
</script>

<template>
    <Head :title="pageTitle" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h2 class="text-xl font-semibold tracking-tight">Key metrics for recent {{ pageTitle }} web pages</h2>
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
