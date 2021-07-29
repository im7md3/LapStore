<template>
    <my-app>
        <div class="flex justify-center items-center w-full h-96 flex-col">
            <h1 class="font-black text-3xl">Thank you for</h1>
            <h1 class="font-black text-3xl mb-2">Your Order</h1>
            <p class="text-sm mb-2">A Confirmation email was sent</p>
            <inertia-link :href="route('landingpage')"
                class="px-14 py-3 border border-gray-500 hover:text-white hover:bg-gray-900">Home Page
            </inertia-link>
        </div>
    </my-app>
</template>

<script>
    import myApp from '@/Layouts/myApp'

    export default {
        components: {
            myApp,
        },




    }

</script>
