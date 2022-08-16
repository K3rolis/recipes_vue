<template>
    <Head title="Welcome"/>

    <Guest>
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
            <div class="mb-4">
                <select v-model="selectedCategory" class="block mt-1 w-full sm:w-1/2 md:w-1/4 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" selected>All categories</option>
                    <option v-for="category in categories" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
            <div v-if="!recipes.data.length && search.length ">
                Search results for the phrase <span class="font-bold"> "{{ search }}" </span>not found
            </div>
            <div v-if="!recipes.data.length && !search.length">
                No recipes
            </div>
            <div class="grid mt-8 grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                <!-- Cards -->
                <div class="rounded overflow-hidden shadow-lg" v-for="recipe in recipes.data" :key="recipe.id">
                    <Link :href="route('recipe.show', recipe.id)">
                        <img class="h-72 w-full rounded-md object-fill"
                             :src="recipe.recipe_url"
                        >
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ recipe.title }} </div>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                    <span v-if="recipe.total_time % 60 === 0"
                          class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                        Total - {{ recipe.total_time }} hr
                    </span>
                            <span v-else-if="recipe.total_time > 60"
                                  class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                        Total - {{ parseInt(recipe.total_time / 60) }} hr {{ recipe.total_time % 60 }} mins
                    </span>
                            <span v-else-if="recipe.total_time < 60"
                                  class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                        Total - {{ recipe.total_time % 60 }} mins
                    </span>
                            <!--                    <span class="block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Category </span>-->
                        </div>
                    </Link>
                </div>
            </div>
            <pagination class="mt-6" :links="recipes.links"/>
        </Crud>
    </Guest>
</template>

<script setup>

import {Head, Link,} from '@inertiajs/inertia-vue3';
import Crud from "@/Components/Crud.vue";
import Guest from "@/Layouts/Guest.vue"
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import pagination from "@/Components/Pagination.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    view: Boolean,
    recipes: Object,
    categories: Object,
})

const search = ref('');
const selectedCategory = ref('')


watch(search, value => {
    Inertia.get('/', { search: value }, {preserveState: true})
})

watch(selectedCategory, value => {
    Inertia.get('/', { category: value}, {preserveState: true})
})

</script>
