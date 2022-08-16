<template>
    <BreezeAuthenticatedLayout>

        <Head title="Categories"/>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <Crud>
            <button @click="isShow = !isShow" class="inline-block px-4 py-3 bg-purple-500 text-white rounded mb-4"> Add
                new category
            </button>

                <div v-if="isShow" class="relative">
                    <form @submit.prevent="form.post(route('admin.categories.store'))">
                    <label for="name" class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"> Category
                        name </label>
                    <input v-model="form.name"
                           type="text"
                           class="block p-2.5 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <button type="submit"
                            :disabled="form.processing"
                            class="absolute top-6 right-0 p-3 text-sm font-medium text-white bg-purple-500 rounded-r-lg border border-purple-500 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                        Submit
                    </button>
                        <div v-if="errors.name" class="text-red-500">
                            {{ errors.name }}
                        </div>
                    </form>
                </div>
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">index</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span
                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category name</span>
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
                <tr v-for="(category, index) in categories.data" :key="category.id">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ ++index }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ category.name }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ category.created_at }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <Link :href="route('admin.categories.edit', category.id)" class="px-2 py-1 bg-blue-500 text-white rounded font-bold uppercase mr-2">edit</Link>

                        <button v-if="$page.props.permissions.administrator" @click="confirmDelete(category.id)" type="button"
                                class="px-2 py-1 bg-red-500 text-white rounded font-bold uppercase">
                            delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="categories.links" />
        </Crud>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Crud from "@/Components/Crud.vue";
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import pagination from "@/Components/Pagination.vue";


export default {
    components: {
        BreezeAuthenticatedLayout,
        Crud,
        Head, Link, pagination
    },
    props: {
        categories: Object,
        errors: Object,
    },
    data() {
        return {
            isShow: false,
        }
    },
    setup(){
        const form = useForm({
            name: ''
        })
        const confirmDelete = (id) => {
            if(confirm('Are you sure? All recipes included this category will lose category value!!')){
                Inertia.delete(route('admin.categories.destroy', id))
            }
        }

        return { form, confirmDelete }
    },
    // methods: {
    //     confirmDelete(id) {
    //         if (confirm('Are you sure? All recipes included this category will lose category ')) {
    //             Inertia.delete(route('categories.destroy', id))
    //         }
    //     }
    // },

}

</script>

