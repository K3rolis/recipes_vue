<template>
    <BreezeAuthenticatedLayout>

        <Head title="Edit Recipe"/>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Recipe
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="form.put(route('admin.recipes.update', form.id))">
                            <div class="mt-4">
                                <label for="title" class="block font-medium text-sm text-gray-700">
                                    Title
                                </label>
                                <input v-model="form.title"
                                       type="text"
                                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <div v-if="errors.title" class="text-red-600">
                                    {{ errors.title }}
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="total_time" class="block font-medium text-sm text-gray-700">
                                    Total time in minutes
                                </label>
                                <input v-model="form.total_time"
                                       type="number"
                                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <div v-if="errors.total_time" class="text-red-600">
                                    {{ errors.total_time }}
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="category_id" class="block font-medium text-sm text-gray-700">
                                    Category
                                </label>
                                <select v-model="form.category_id"
                                       class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option v-for="category in categories" :key="category.id" :value="category.id"> {{ category.name }}</option>
                                </select>
                                    <div v-if="errors.category_id" class="text-red-600">
                                    {{ errors.category_id }}
                                </div>
                            </div>

                            <div class="mt-4 rounded-md">
                                <label for="ingredients" class="block font-medium text-sm text-gray-700">
                                    Ingredients
                                </label>
                                <QuillEditor v-model:content="form.ingredients" contentType="html" toolbar="essential"
                                             theme="snow" style="height:250px"/>
                                <div v-if="errors.ingredients" class="text-red-600">
                                    {{ errors.ingredients }}
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="instructions" class="block font-medium text-sm text-gray-700">
                                    Instructions
                                </label>
                                <QuillEditor v-model:content="form.instructions" contentType="html" toolbar="essential"
                                             theme="snow" style="height:250px"/>
                                <div v-if="errors.instructions" class="text-red-600">
                                    {{ errors.instructions }}
                                </div>
                            </div>

                            <div class="py-4">
                                <button type="submit" :disabled="form.processing"
                                        class="inline-flex items-center px-3 py-2 bg-purple-500 text-white rounded">
                                    Save Post
                                </button>
                                <Link :href="route('admin.recipes.index')"
                                      class="inline-flex items-center mx-5 text-purple-500 font-bold" as="button">
                                    Cancel
                                </Link>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head, Link,
        QuillEditor
    },
    props: {
        recipe: Object,
        categories: Object,
        errors: Object
    },
    setup(props) {
        const form = useForm({
            id: props.recipe.id,
            title: props.recipe.title,
            total_time: props.recipe.total_time,
            category_id: props.recipe.category_id,
            ingredients: props.recipe.ingredients,
            instructions: props.recipe.instructions,
        })
        return {form}
    }
}
</script>
