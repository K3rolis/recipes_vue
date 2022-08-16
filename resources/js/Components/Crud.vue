<template>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    <div v-show="visible" v-if="$page.props.flash.message" class="text-green-600">
                        {{ $page.props.flash.message }}
                    </div>
                    <div class="overflow-hidden overflow-x-auto p-4 bg-white border-gray-200">
                        <div class="min-w-full align-middle">
                            <slot />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            visible: true
        }
    },
    // created() {
    //     setTimeout(() => this.visible = false, 3000)
    // },
    props: ['props.flash.message'],


}

</script>
