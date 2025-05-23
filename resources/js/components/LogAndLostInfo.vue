<script setup lang="ts">
    import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
    import { useInitials } from '@/composables/useInitials';
    const { getInitials } = useInitials();
</script>

<template>
    <Avatar class="h-8 w-8 overflow-hidden rounded-lg">
        <AvatarImage 
            src="https://ui-avatars.com/api/?name=L&background=0D8ABC&color=fff&bold=true&size=128"
            alt="Log&List" />
        <AvatarFallback class="rounded-lg text-black dark:text-white">
            {{ getInitials("Log&List") }}
        </AvatarFallback>
    </Avatar>

    <div class="grid flex-1 text-left text-sm leading-tight">
        <span class="truncate font-medium">Log&List</span>
        <span class="truncate text-xs text-muted-foreground">Contents</span>
    </div>
</template>
