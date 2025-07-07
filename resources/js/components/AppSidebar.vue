<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavLogAndList from '@/components/NavLogAndList.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { 
        Folder, 
        LayoutGrid,
        FileUser,
        NotebookTabs,
        Camera,
        ExternalLink,
        TvMinimalPlay,
        // LogOut
    } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard/dimensions-data',
        icon: LayoutGrid,
    },
    {
        title: 'KJK-Portfolio',
        href: '/kjkportfolio/metrics-data',
        icon: FileUser,
    },
    {
        title: 'Log&List',
        href: '/logandlist/metrics-data',
        icon: NotebookTabs
    }
];

const footerNavItems: NavItem[] = [
    {   
        title: 'KJK-Portfolio',
        href: 'https://kjk-portfolio.vercel.app',
        icon: FileUser,
    },  
    {   
        title: 'Log&List',
        href: 'https://www.log-and-list.com',
        icon: NotebookTabs,
    },  
    {
        title: 'LinkedIn',
        href: 'https://linkedin.com/in/jungyeom-kim-63625130a',
        icon: ExternalLink,
    },
    {
        title: 'Github Repo',
        href: 'https://github.com/GitHubKimJunGyeom',
        icon: Folder,
    },
    {
        title: 'Instagram',
        href: 'https://www.instagram.com/tokyo_kim90/',
        icon: Camera,
    },
    {
        title: 'Youtube',
        href: 'https://www.youtube.com/@cento7517',
        icon: TvMinimalPlay,
    },

];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard.dimensions-data.index')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
            <NavLogAndList />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <Link class="block w-full" method="post" :href="route('logout')" as="button">
                <!-- <LogOut class="mr-2 h-4 w-4" /> -->
                Log out
            </Link>
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
