<template>
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</BreezeNavLink>
        <BreezeNavLink :href="route('admin.recipes.index')" :active="route().current('admin.recipes.index')">Recipes</BreezeNavLink>
        <BreezeNavLink :href="route('admin.categories.index')" :active="route().current('admin.categories.index')">Categories</BreezeNavLink>
        <BreezeNavLink :href="route('admin.comments.index')" :active="route().current('admin.comments.index')">Comments</BreezeNavLink>
    </div>
</template>

<script setup>
import BreezeNavLink from '@/Components/NavLink.vue';
</script>

<style scoped>

</style>
