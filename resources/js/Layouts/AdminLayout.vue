<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Navigation from '@/Layouts/Partials/Navigation.vue';
import SearchBox from '@/Layouts/Partials/SearchBox.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, onMounted, onBeforeMount } from 'vue';
import { InertiaProgress } from '@inertiajs/progress';
import swal from 'sweetalert';

const showingNavigationDropdown = ref(false);
defineProps({
    header: {
        type: String,
        default: null,
    },
    description: {
        type: String,
        default: null,
    },
    searchUrl: String,
    filters : Object,
});
const closeMe = (event) => {
    console.log(event.target.parentElement) // parent element
}
onMounted(() => {
    if(usePage().props.flash.success)
    {
        swal('Success!', usePage().props.flash.success,'success');
        usePage().props.flash.success = null;
    }
    if(usePage().props.flash.failed)
    {
        swal('Failed!', usePage().props.flash.failed,'error');
        usePage().props.flash.failed = null;
    }
});
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <div class="flex bg-white">
                <div class="flex space-x-4 w-80 border-b border-gray-300 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                                <button
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                >
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path
                                            :class="{
                                                hidden: showingNavigationDropdown,
                                                'inline-flex': !showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                                hidden: !showingNavigationDropdown,
                                                'inline-flex': showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                    <div class="">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                                <Link :href="route('home')" :class="'mx-auto'">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>
                    </div>
                </div>
                <nav class="bg-white border-b border-gray-300 w-full">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="flex">
                            </div>

                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <!-- Settings Dropdown -->
                                <div class="ml-3 relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {{ $page.props.auth.user.name }}

                                                    <svg
                                                        class="ml-2 -mr-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>


                        </div>
                    </div>

                </nav>
            </div>
            <div class="flex space-x-2">
                <nav :class="{ 'block origin-top-right left-0 top-100 fixed z-40': showingNavigationDropdown, hidden: !showingNavigationDropdown, }"
                        class="sm:hidden md:block lg:block w-80 h-screen bg-white drop-shadow-xl sticky top-0 overflow-y-auto scrollbar-thin scrollbar-thumb-white scrollbar-thumb-rounded-full scrollbar-track-indigo-100">
                    <Navigation />
                    <div class="lg:hidden mt-3 space-y-1">

                    </div>
                    <!-- <Sidebar /> -->
                </nav>
                <div class="w-full">
                    <!-- Page Heading -->
                    <header class="pt-8" v-if="header || description || $slots.action">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="flex flex-wrap justify-between">

                                <div class="lg:flex space-x-4">
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-if="header">{{ header }}</h2>
                                    <span class="text-sm text-gray-500 pt-1" v-if="description">{{ description }}</span>
                                </div>
                                <div class="place-self-end ...">
                                    <slot name="action" />
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Page Content -->
                    <main class="py-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                            <div class="float-right py-2" v-if="searchUrl">
                                <SearchBox :searchUrl="searchUrl" :filters="filters"/>
                            </div>
                            <slot />
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
