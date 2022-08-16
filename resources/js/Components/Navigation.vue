<template>
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <BreezeNavLink :href="route('recipes.index')" :active="route().current('recipes.index')">Home</BreezeNavLink>
        <BreezeNavLink v-if="$page.props.permissions.administrator || $page.props.permissions.editor" :href="route('admin.recipes.index')" :active="route().current('admin.recipes.index')">Recipes</BreezeNavLink>
        <BreezeNavLink v-if="$page.props.permissions.administrator || $page.props.permissions.editor" :href="route('admin.categories.index')" :active="route().current('admin.categories.index')">Categories</BreezeNavLink>
        <BreezeNavLink v-if="$page.props.permissions.administrator || $page.props.permissions.editor" :href="route('admin.comments.index')" :active="route().current('admin.comments.index')">Comments</BreezeNavLink>
    </div>
</template>

<script setup>
import BreezeNavLink from '@/Components/NavLink.vue';

</script>
