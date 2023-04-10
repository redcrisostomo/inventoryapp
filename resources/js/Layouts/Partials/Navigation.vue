<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import MultilevelMenu from '@/Components/MultilevelMenu/MultilevelMenu.vue';

const props = defineProps({
    menus: {
        type: Object,
        default: [
            {
                label: 'Products',
                links: [
                    {
                        name : 'All Products',
                        route_name : 'products.index',
                    },
                    {
                        name : 'Create Product',
                        route_name : 'products.create',
                    },

                ]
            },
            {
                label: 'Videos',
                links: [
                    {
                        name : 'Sample Video',
                        route_name : 'video.sample',
                    },

                ]
            },
        ]
    }
});
</script>
<template>
    <div class="h-screen pt-2 pb-3 space-y-1" style="width:100% !important;">
        <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
            Dashboard
        </ResponsiveNavLink>
        <div class="lg:hidden">
            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
        </div>
        <MultilevelMenu v-for="menu in menus" :key="menu.label" :label="menu.label" :links="menu.links">
        </MultilevelMenu>
        <!-- <div v-for="menu in $page.props.sharedMenus" :key="menu.name">
            <MultilevelMenu v-if="menu.children" :label="menu.name" :links="menu.children"
            />
            <ResponsiveNavLink v-else-if="menu.route_name" :href="menu.route_name ? route(menu.route_name) : '#'" :class="text-sm">
                {{ menu.name }}
            </ResponsiveNavLink>
            <div v-else-if="menu.menus">
                <h6
                    class="pl-4 md:min-w-full text-gray-500 text-xs uppercase font-bold tracking-widest block pt-4 pb-1 no-underline"
                >
                    {{ menu.name }}
                </h6>
                <div v-for="link in menu.menus" :key="link.id" class="pl-3">
                    <MultilevelMenu v-if="link.children" :label="link.name" :links="link.children"
                    />
                </div>
            </div>
        </div> -->
        <div class="lg:hidden">
            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                Log Out
            </ResponsiveNavLink>
        </div>
    </div>
</template>
