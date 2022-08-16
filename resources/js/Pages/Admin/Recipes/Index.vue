<template>
    <BreezeAuthenticatedLayout>

        <Head title="Recipes"/>
        <template #header>
            <div class="flex justify-between w-full">
                <div class="flex mt-2 content-center font-semibold text-xl text-gray-800 leading-tight">
                    Recipes
                </div>
                <div class="flex w-full sm:w-1/2 ml-5">
                    <div class="flex items-center pointer-events-none relative">
                        <svg aria-hidden="true" class="absolute ml-1 text-right w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input v-model="search" type="text" placeholder="Search..." class="pl-6 rounded w-full">
                </div>
            </div>
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
                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</span>
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
                <tr v-for="recipe in recipes.data" :key="recipe.id">
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
                        <span v-if="recipe.name === null" class="text-red-500"> WITHOUT CATEGORY </span>
                        <span v-else-if="recipe.name.name"> {{ recipe.name.name }}</span>

                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ recipe.created_at }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <Link :href="route('admin.recipes.edit', recipe.id)"
                              class="px-2 py-1 bg-blue-500 text-white rounded font-bold uppercase mr-2" as="button">edit
                        </Link>
                        <button v-if="$page.props.permissions.administrator" @click="destroy(recipe.id)" type="button"
                                class="px-2 py-1 bg-red-500 text-white rounded font-bold uppercase">
                            delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="recipes.links" />
            <div v-if="!recipes.data.length "> <span class="font-bold mt-2"> "{{ search }}" </span> title or ID does not exist</div>
        </Crud>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia"
import Crud from "@/Components/Crud.vue"
import {ref, watch} from "vue";
import pagination from "@/Components/Pagination.vue";

export default {
    components: {
        Head, Link,
        BreezeAuthenticatedLayout,
        Crud, pagination
    },
    props: {
        category: Object,
        recipes: Object,
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
        let search = ref('');

        watch (search, value => {
            Inertia.get('/admin/recipes/', {search: value}, {
                preserveState: true
            })
        })
        return {destroy, search}
    }

}
</script>

