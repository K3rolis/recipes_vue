<template>
    <Guest>

        <Head title="Edit Comment"/>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Comment
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form @submit.prevent="form.patch(route('comment.update', form.id))">
                            <div class="mt-4">
                                <label for="Comment" class="block font-medium text-sm text-gray-700">
                                    Comment
                                </label>
                                <textarea
                                    v-model="form.comment"
                                    type="text"
                                    rows="5"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </textarea>
                                <div>
                                    <div v-if="errors.comment" class="text-red-600">
                                        {{ errors.comment }}
                                    </div>
                                </div>
                            </div>
                            <div class="py-4">
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-2 bg-purple-500 text-white rounded">
                                    Save Comment
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
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import Guest from "@/Layouts/Guest.vue";

export default {
    components: {
        Guest,
        Head, Link,
    },
    props: {
        comment: Object,
        errors: Object,
    },
    setup(props){
        const form = useForm({
            id: props.comment.id,
            comment: props.comment.comment
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
