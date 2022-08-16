<template>
    <Guest>

        <Head title="Edit Category"/>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Category
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="form.patch(route('admin.categories.update', form.id))">
                            <div class="mt-4">
                                <label for="Comment" class="block font-medium text-sm text-gray-700">
                                    Category
                                </label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <div>
                                    <div v-if="errors.name" class="text-red-500">
                                        {{ errors.name }}
                                    </div>
                                </div>
                            </div>
                            <div class="py-4">
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-2 bg-purple-500 text-white rounded">
                                    Save Category
                                </button>
                                <Link href="#"
                                      @click="back"
                                      class="inline-flex items-center mx-5 text-purple-500 font-bold">
                                    Cancel
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </Guest>
</template>

<script>
// import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import Guest from "@/Layouts/Guest.vue";

export default {
    components: {
        Guest,
        Head, Link,
    },
    props: {
        category: Object,
        errors: Object,
    },
    setup(props){
        const form = useForm({
            id: props.category.id,
            name: props.category.name
        })
        return { form }
    },
    methods: {
        back() {
            window.history.back();
        },
    }

}

</script>
