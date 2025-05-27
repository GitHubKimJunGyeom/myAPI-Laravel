<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Link, Head, router} from '@inertiajs/vue3';
    import { Button } from '@/components/ui/button';
    import { Label } from '@/components/ui/label';
    import { type PathNote } from '@/types/LogAndList';

    const pageTitle = 'Log&List';
    const pageSubTitle = 'PathNote';
    const pageSub2Title = 'Show PathNote';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: pageTitle,
            href: '/logandlist/metrics-data',
        },
        {
            title: pageSubTitle,
            href: '/logandlist/path-notes-data',
        },
        {
            title: pageSub2Title,
            href: '/logandlist/path-notes-data/show',
        },
    ];

    defineProps<{
        logAndListPathNote: PathNote;
    }>();

    const deleteNote = (targetId: number) => {
        if (confirm('Are you sure you want to delete this?')) {
            router.delete(route('logandlist.path-notes-data.destroy', targetId));
        }
        else {
            console.log('Deletion has been cancelled.');
        }
    }

</script>

<template>
    <Head :title="pageSub2Title" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col items-center justify-center gap-6 bg-background p-6 md:p-10">
            <div class="w-full max-w-sm">
                <div class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="title">Title</Label>
                            <span class="text-sm text-muted-foreground">{{ logAndListPathNote.title }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="content_ja">Context (Japanese)</Label>
                            <span class="text-sm text-muted-foreground">{{ logAndListPathNote.content_ja }}</span>
                        </div>
                        <div class="grid gap-2">
                            <Label for="content_ja">Context (Korean)</Label>
                            <span class="text-sm text-muted-foreground">{{ logAndListPathNote.content_ko }}</span>
                        </div>
                        <div class="flex text-center">
                            <Link   
                                :href="route('logandlist.path-notes-data.edit', logAndListPathNote.id)"
                                class="text-blue-500 hover:underline mt-4 w-full text-2xl"
                            >
                                → Edit
                            </Link>
                        </div>
                        <Button type="button" class="mt-4 w-full" 
                            @click="deleteNote(logAndListPathNote.id)" variant="destructive"  
                        >
                            Delete
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
