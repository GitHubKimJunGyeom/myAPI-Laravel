<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head, useForm } from '@inertiajs/vue3';
    import InputError from '@/components/InputError.vue';
    import { Button } from '@/components/ui/button';
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';
    import { LoaderCircle } from 'lucide-vue-next';
    import { type PathNote } from '@/types/LogAndList';

    const pageTitle = 'Log&List';
    const pageSubTitle = 'PathNote';
    const pageSub2Title = 'Edit PathNote';
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
            href: '/logandlist/path-notes-data/create',
        },
    ];

    const prop = defineProps<{
        logAndListPathNote: PathNote;
    }>();

    const form = useForm({
        id: prop.logAndListPathNote.id,
        title: prop.logAndListPathNote.title,
        content_ja: prop.logAndListPathNote.content_ja,
        content_ko: prop.logAndListPathNote.content_ko,
    });

    const submit = () => {
        form.patch(route('logandlist.path-notes-data.update', form.id), {
            onSuccess: () => {
                console.log('Path Note updated successfully!');
            },
            onError: (errors) => {
                console.log('Validation errors:', errors);
            },
        });
    };
    
</script>

<template>
    <Head :title="pageSub2Title" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col items-center justify-center gap-6 bg-background p-6 md:p-10">
            <div class="w-full max-w-sm">
                <form @submit.prevent="submit" class="flex flex-col gap-6">
                    <div class="grid gap-6">
                        <div class="grid gap-2">
                            <Label for="title">Title</Label>
                            <Input
                                id="title"
                                type="input"
                                autofocus
                                :tabindex="1"
                                autocomplete="title"
                                v-model="form.title"
                                placeholder="title"
                            />
                            <InputError :message="form.errors.title" />
                        </div>

                        <div class="grid gap-2">
                            <div class="flex items-center justify-between">
                                <Label for="content_ja">Context (Japanese)</Label>
                            </div>
                           <textarea
                                id="content_ja"
                                :tabindex="2"
                                v-model="form.content_ja"
                                placeholder="Context (Japanese)"
                                class="min-h-[120px] rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                            />
                            <InputError :message="form.errors.content_ja" />
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center justify-between">
                                <Label for="content_ko">Context (Korean)</Label>
                            </div>
                            <textarea
                                id="content_ko"
                                :tabindex="2"
                                v-model="form.content_ko"
                                placeholder="Context (Korean)"
                                class="min-h-[120px] rounded-md border border-input bg-background px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
                            />
                            <InputError :message="form.errors.content_ko" />
                        </div>
                        <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Edit
                        </Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
