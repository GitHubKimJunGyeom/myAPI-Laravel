<script setup lang="ts">
import LogAndListInfo from '@/components/LogAndListInfo.vue';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem, useSidebar } from '@/components/ui/sidebar';
import { ChevronDown } from 'lucide-vue-next';
import LogAndListMenuContent from './LogAndListMenuContent.vue';

const { isMobile, state } = useSidebar();
</script>

<template>
  <SidebarGroup class="px-2 py-0">
    <SidebarGroupLabel>Log&List Content</SidebarGroupLabel>
    <SidebarMenu>
      <SidebarMenuItem>
        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <SidebarMenuButton 
              class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground"
            >
              <LogAndListInfo />
              <ChevronDown class="ml-auto size-4" />
            </SidebarMenuButton>
          </DropdownMenuTrigger>
          <DropdownMenuContent 
            class="w-(--reka-dropdown-menu-trigger-width) min-w-56 rounded-lg"
            :side="isMobile ? 'bottom' : state === 'collapsed' ? 'left' : 'bottom'"
            align="end" 
            :side-offset="4"
          >
            <LogAndListMenuContent />
          </DropdownMenuContent>
        </DropdownMenu>
      </SidebarMenuItem>
    </SidebarMenu>
  </SidebarGroup>
</template>
