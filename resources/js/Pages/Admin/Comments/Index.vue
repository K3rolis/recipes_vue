<template>
    <BreezeAuthenticatedLayout>

        <Head title="Recipes" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Recipes
            </h2>
        </template>
        <Crud>
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Comment</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">user email</span>
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
                <tr v-for="comment in comments.data" :key="comment.id">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ comment.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ comment.comment }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ comment.user_name.email}}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ comment.created_at }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <Link :href="route('admin.comments.edit', comment.id)" class="px-2 py-1 bg-blue-500 text-white rounded font-bold uppercase mr-2" as="button">edit</Link>
                        <button v-if="$page.props.permissions.administrator" @click="confirmDelete(comment.id)" type="button" class="px-2 py-1 bg-red-500 text-white rounded font-bold uppercase">
                            delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="comments.links"/>
        </Crud>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Crud from "@/Components/Crud.vue"
import {Inertia} from "@inertiajs/inertia";
import pagination from "@/Components/Pagination.vue";

export default {
    components: {
        Head, Link,
        BreezeAuthenticatedLayout,
        Crud, pagination
    },
    props: {
        comments: Object
    },
    methods: {
        confirmDelete(id) {
            if(confirm('Are you sure want to delete this comment?')) {
                Inertia.delete(route('admin.comments.destroy', id))
            }
        }
    }
}
</script>

