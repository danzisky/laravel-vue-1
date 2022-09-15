<script setup>
import { ref } from 'vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>
<template>
    <div class="font-mono text-normal">
        <div class="min-h-screen bg-gray-100 font-nova">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex space-x-8">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <BreezeNavLink :href="route('base')" :active="route().current('base')" class="h-full">
                                    Home
                                </BreezeNavLink>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                                <BreezeNavLink :href="route('test')" :active="route().current('test')" class="h-full">
                                    Test
                                </BreezeNavLink>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="h-full">
                <div class="m-2 sm:m-auto w-full h-full bg-slate-300_">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<script>
export default {
}
</script>

<style>
    html {
        font-family: Proxima Nova, system-ui, sans-serif;
    }
</style>