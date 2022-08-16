<template>

    <Guest>
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <div class="overflow-hidden overflow-x-auto p-4 bg-white border-gray-200 my-3">
                        <div v-show="visible" v-if="$page.props.flash.message" class="text-green-600">
                            {{ $page.props.flash.message }}
                        </div>
                        <div v-if="errors.comment" class="text-red-600">
                            {{ errors.comment }}
                        </div>
                        <span class="font-bold text-xl m-5"> {{ recipe.title }}</span>
                        <div class="min-w-full align-middle my-3">
                            <div
                                class="grid grid-flow-row grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5 mb-3">
                                <!-- Photo-->
                                <div
                                    class="rounded overflow-hidden shadow-lg md:col-span-2 lg:grid-cols-2 xl:grid-cols-2">
                                    <img class="w-full"
                                         alt="recipe"
                                         :src="recipe.recipe_url"
                                         loading="lazy"
                                    >
                                </div>
                                <!--Ingredients -->
                                <div class="rounded overflow-hidden shadow-lg md:col-span-1">
                                    <div class="px-6 py-4">
                                        <div class="text-base mb-2">
                                            <span class="font-bold">Total time: </span>
                                            <span class="font-light"
                                                  v-if="recipe.total_time % 60 === 0">{{ recipe.total_time / 60 }} hr</span>
                                            <span v-else-if="recipe.total_time > 60">{{
                                                    parseInt(recipe.total_time / 60)
                                                }} hr {{ recipe.total_time % 60 }} mins</span>
                                            <span v-else-if="recipe.total_time < 60">{{
                                                    recipe.total_time % 60
                                                }} mins</span>
                                        </div>
                                        <div class="font-bold text-base mb-2">Ingredients:</div>
                                        <p class="text-gray-700 text-sm" v-html="recipe.ingredients"></p>
                                    </div>
                                </div>
                            </div>
                            <!--Instructions -->
                            <span class="uppercase text-xl px-5"> instructions</span>
                            <hr class="mt-2">
                        </div>
                        <span v-html="recipe.instructions"></span>
                    </div>
                </div>
            </div>
        </div>
        <!--Comments -->
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 pt-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">

                    <div class="uppercase text-xl px-5 mb-2"> Comments: {{ comments.length }}</div>
                    <div v-if="$page.props.auth.user" class="text-base mt-5 mb-2"> Leave a comment here
                    <form @submit.prevent="form.post(route('comment.store'))">
                        <div>
                            <textarea v-model="form.comment" class="w-full resize-none mb-2" rows="5" placeholder="Comment..."></textarea>
                            <button class="px-4 py-3 bg-purple-500 text-white rounded mb-4"> Submit</button>
                        </div>
                    </form>
                    </div>
                    <div v-else class="mb-3">
                        <Link class="text-blue-500" :href="route('login')">Only registered users can add new comment</Link>
                    </div>
                    <div v-for="comment in comments" :key="comment.id">
                        <div class="border-gray-400-500 border p-6">
<!--                            <div v-if="recipe.id === comment.recipe_id" class="border-gray-400-500 border p-6">-->
                            <div class="flex justify-between">
                                <div class="text-sm text-gray-400">
                                   {{ comment.user_name }}
<!--                                    : {{ recipe.id }}-->
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{ comment.created_at }}
                                </div>
                            </div>
                            <div class="my-3">
                                {{ comment.comment }}
                            </div>

                            <div v-if="auth.user && auth.user.name === comment.user_name" class="text-right">
                                <Link @click="confirmDelete(comment.id)" class="border-gray-400 border p-1 mx-2 text-sm"> Delete</Link>
                                <Link :href="route('comment.edit', comment.id)" class="border-gray-400 border p-1 text-sm "> Edit</Link>
                            </div>
                            <div v-else-if="auth.user && auth.user.name !== comment.user_name && $page.props.permissions.administrator" class="text-right">
                                <Link @click="confirmDelete(comment.id)" class="border-gray-400 border p-1 mx-2 text-sm"> Delete</Link>
                            </div>
                            <div v-else-if="auth.user && auth.user.name !== comment.user_name && $page.props.permissions.editor" class="text-right">
                                <Link :href="route('comment.edit', comment.id)" class="border-gray-400 border p-1 text-sm "> Edit</Link>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </Guest>
</template>

<script setup>
import Crud from "@/Components/Crud.vue";
import Guest from "@/Layouts/Guest.vue"
import {Link, useForm, ref} from "@inertiajs/inertia-vue3";
import {computed, onMounted} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps ({
        recipe: Object,
        comments: Object,
        auth: Object,
        errors: Object,
    })

const form = useForm({
    comment: '',
    recipe_id: props.recipe.id,
    user_id: props.auth.user ? props.auth.user.id : ''
})

const comments = computed(() => {
    return props.comments.filter(function(comment) {
        return comment.recipe_id === props.recipe.id
    })
})

function confirmDelete(id) {
    if(confirm('Are you want to delete this comment?')){
        Inertia.delete(route('comment.destroy', id))
    }
}

const visible = true;

</script>
