<template>
    <BreezeResponsiveNavLink :href="route('recipes.index')" :active="route().current('recipes.index')">Home</BreezeResponsiveNavLink>
    <BreezeResponsiveNavLink v-if="$page.props.permissions.administrator || $page.props.permissions.editor" :href="route('admin.recipes.index')" :active="route().current('admin.recipes.index')">Recipes</BreezeResponsiveNavLink>
    <BreezeResponsiveNavLink v-if="$page.props.permissions.administrator || $page.props.permissions.editor" :href="route('admin.categories.index')" :active="route().current('admin.categories.index')">Categories</BreezeResponsiveNavLink>
    <BreezeResponsiveNavLink v-if="$page.props.permissions.administrator || $page.props.permissions.editor" :href="route('admin.comments.index')" :active="route().current('admin.comments.index')">Comments</BreezeResponsiveNavLink>
</template>

<script>
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
export default {
    components: {
        BreezeResponsiveNavLink
    }
}
</script>
