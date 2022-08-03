<template>
    <BreezeAuthenticatedLayout>

        <Head title="Recipes" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Recipes
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <div v-show="visible" v-if="$page.props.flash.message" class="text-green-600">
                            {{ $page.props.flash.message }}
                        </div>
                        <div class="overflow-hidden overflow-x-auto p-4 bg-white border-gray-200">
                            <div class="min-w-full align-middle">
                                <Link :href="route('recipes.create')" class="inline-block px-4 py-3 bg-purple-500 text-white rounded mb-4"> Add new recipe </Link>
                                <table class="min-w-full divide-y divide-gray-200 border">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ingredients</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Instructions</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created at</span>
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left">
                                            <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                    <tr v-for="recipe in recipes" :key="recipe.id">
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
                                            <Link :href="route('recipes.edit', recipe.id)" class="px-2 py-1 bg-blue-500 text-white rounded font-bold uppercase mr-2">edit</Link>
                                            <button @click="destroy(recipe.id)" type="button" class="px-2 py-1 bg-red-500 text-white rounded font-bold uppercase">
                                                delete
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia"

export default {
    data() {
        return {
            visible: true
        }
    },
    components: {
        Head, Link,
        BreezeAuthenticatedLayout
    },
    props: {
        recipes: Object
    },
    created(){
        setTimeout(() => this.visible = false, 3000)
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
                Inertia.delete(route('recipes.destroy', id))
            }
        }
        return { destroy }
    }
}
</script>

