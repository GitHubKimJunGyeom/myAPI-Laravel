<script setup lang="ts">
import { DropdownMenuGroup, DropdownMenuItem, DropdownMenuSeparator } from '@/components/ui/dropdown-menu';
import { Link } from '@inertiajs/vue3';
import { ScrollText, MessageCircleMore } from 'lucide-vue-next';
</script>

<template>
  <DropdownMenuGroup>
    <DropdownMenuItem :as-child="true">
      <Link class="block w-full" :href="route('logandlist.path-notes-data.index')" as="button">
        <ScrollText class="mr-2 h-4 w-4" />
          PathNote
      </Link>
    </DropdownMenuItem>
  </DropdownMenuGroup>
  <DropdownMenuSeparator />
  <DropdownMenuItem :as-child="true">
    <Link class="block w-full" :href="route('logandlist.comments-data.index')" prefetch as="button">
      <MessageCircleMore class="mr-2 h-4 w-4" />
        Comments
    </Link>
  </DropdownMenuItem>
</template>
