<script setup>

import { Link } from '@inertiajs/inertia-vue3';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import {ref} from "vue";
import Navigation from "@/Components/Navigation.vue"
import BreezeResponsiveNavigation from "@/Components/BreezeResponsiveNavigation.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue"

const showingNavigationDropdown = ref(false);

</script>

<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('recipes.index')">
                            <BreezeApplicationLogo class="block h-9 w-auto"/>
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <Navigation/>
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

                    </div>
                </div>
                <!-- Log in, register links -->

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <div class="ml-3 relative">
                        <div class="align-right left-48">
                            <div v-if="!$page.props.auth.user">
                                <BreezeNavLink :href="route('login')" class="mr-4">Log in</BreezeNavLink>
                                <BreezeNavLink :href="route('register')">Register</BreezeNavLink>
                            </div>
                            <div v-else>
                                <div>{{ $page.props.auth.user.name }}
                                    <span v-if="$page.props.permissions.administrator" class="text-red-500"> Admin </span>
                                    <span v-if="$page.props.permissions.editor" class="text-blue-500"> Editor </span>
                                </div>
                                <BreezeNavLink :href="route('logout')" method="post">
                                    log out
                                </BreezeNavLink>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"/>
                            <path
                                :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavigation/>
            </div>

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4" v-if="!$page.props.auth">
                    <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    <span v-if="$page.props.permissions.administrator" class="text-red-500"> Admin </span>
                    <span v-if="$page.props.permissions.editor" class="text-blue-500"> Editor </span>
                </div>

                <div class="mt-3 space-y-1">
                    <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </BreezeResponsiveNavLink>
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
    <main>
        <slot />
    </main>

</template>
