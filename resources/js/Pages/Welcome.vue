<script setup>

import {Head, Link,} from '@inertiajs/inertia-vue3';
import Crud from "@/Components/Crud.vue";
import Guest from "@/Layouts/Guest.vue"
import {ref} from "vue";

const showingNavigationDropdown = ref(false);
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    view: Boolean,
    recipes: Object
})

</script>

<template>
    <Head title="Welcome"/>

    <Guest>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Recipes
            </h2>
        </template>

        <Crud>
            <li>Beef Recipes</li>
            <li>Chicken Recipes</li>
            <li>Fish & Seafood Recipes</li>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                <!-- Cards -->
                <div class="rounded overflow-hidden shadow-lg" v-for="recipe in recipes" :key="recipe.id">
                    <Link :href="route('recipe.show', recipe.id)">
                        <img class="h-50 w-50 rounded-md"
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
        </Crud>
    </Guest>
</template>
