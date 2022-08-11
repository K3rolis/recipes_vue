<template>
    <BreezeAuthenticatedLayout>

        <Head title="Recipes"/>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Recipes
            </h2>
        </template>
        <Crud>
            <Link :href="route('admin.recipes.create')"
                  class="inline-block px-4 py-3 bg-purple-500 text-white rounded mb-4" as="button"> Add new recipe
            </Link>
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Photo</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span
                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ingredients</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span
                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Instructions</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span
                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created at</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span
                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <tr v-for="recipe in recipes" :key="recipe.id">
                    <td>
                        <img
                            class="h-20 w-69 rounded-md"
                            alt="recipe"
                            :src="recipe.recipe_url"
                            loading="lazy"
                        >
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ recipe.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ recipe.title }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <span v-html="recipe.ingredients"></span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <span v-html="recipe.instructions"></span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ recipe.created_at }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <Link :href="route('admin.recipes.edit', recipe.id)"
                              class="px-2 py-1 bg-blue-500 text-white rounded font-bold uppercase mr-2" as="button">edit
                        </Link>
                        <button @click="destroy(recipe.id)" type="button"
                                class="px-2 py-1 bg-red-500 text-white rounded font-bold uppercase">
                            delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </Crud>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia"
import Crud from "@/Components/Crud.vue"

export default {
    components: {
        Head, Link,
        BreezeAuthenticatedLayout,
        Crud
    },
    props: {
        recipes: Object
    },
    // methods: {
    //     deleteRecipe(index, recipe) {
    //         axios.delete(route('recipes.destroy', recipe.id))
    //             .then((res) => {
    //                 this.recipes.splice(index, 1)
    //             })
    //     }
    // },
    setup() {
        const destroy = (id) => {
            if (confirm('Do you want to delete this recipe?')) {
                Inertia.delete(route('admin.recipes.destroy', id))
            }
        }
        return {destroy}
    }
}
</script>
