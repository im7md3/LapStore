<template>
    <my-app>

        <template #Linksbreadcrumbs>
            <inertia-link :href="route('landingpage')" class="text-blue-700 font-black">Home</inertia-link> >
            <span class="font-black">Shopping Cart</span>
        </template>

        <div class="mt-20">
            <div class="container ">
                <div v-if="$page.props.user" class="">
                    <div v-if="productInCart.length>0" class="grid grid-cols-12">

                        <div class="col-span-8 ">
                            <h3 class="mb-10 font-black">{{ productInCart.length }} Items in Shopping Cart</h3>
                            <div class="grid grid-cols-12 gap-4 py-5 border-b border- shadow-lg" v-for="product in productInCart"
                                :key="product.id">
                                <inertia-link :href="route('products.show',product.slug)" class="col-span-3 ">
                                    <img :src="$page.props.asset + product.image" alt="">
                                </inertia-link>
                                <div class="col-span-4">
                                    <p class="font-black">{{ product.name }}</p>
                                    <p class="font-black mt-2 text-gray-500 text-sm	">{{ product.details }}</p>
                                </div>
                                <div class="col-span-2 text-xs place-self-center">
                                    <p @click="deleteOne(product)"
                                        class="cursor-pointer block font-black mt-2 text-yellow-500 shadow-lg p-2 mb-2">Remove One</p>
                                    <p @click="deleteAll(product)"
                                        class="cursor-pointer  block font-black mt-2 text-red-500 shadow-lg p-2 mb-2">Remove All</p>
                                </div>

                                <input type="number" class="pl-2 pr-0 h-8 w-16 place-self-center col-span-1"
                                    :value="product.pivot.number">

                                <div class="font-black  text-xs place-self-center col-span-2">
                                    ${{ parseFloat (product.price) * product.pivot.number }}
                                </div>
                            </div>


                            <div class="bg-gray-100 p-5 flex shadow-lg">
                                <div class="text-xs w-80">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                    Facere asperiores delectus obcaecati, assumenda sint voluptatem quam excepturi,
                                    nesciunt modi ipsum explicabo eligendi optio, </div>
                                <div class="ml-auto flex">
                                    <div class="mr-5">
                                        <p class="text-xs">Subtotal</p>
                                        <p class="text-xs">Tax</p>
                                        <p class="font-black mt-2">Total</p>
                                    </div>
                                    <div class="ml-5">
                                        <p class="text-xs">${{ totalPrice }}</p>
                                        <p class="text-xs">${{ tax }}</p>
                                        <p class="font-black mt-2">${{ totalPrice + tax }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="flex justify-between mt-7">
                                <inertia-link :href="route('shop')" class="px-14 py-3 border border-gray-500    hover:text-white hover:bg-gray-900 shadow-lg">Shopping
                                </inertia-link>
                                <inertia-link :href="route('checkout.index')" class="px-14 py-3 border border-gray-500  bg-green-400 text-white hover:bg-green-500 shadow-lg">Procceed to Checkout
                                </inertia-link>
                            </div>

                        </div>

                        <div class="col-span-4">

                        </div>
                    </div>

                    <div v-else class="">
                        <p class=" mb-5 p-3 bg-blue-400 text-white font-black">No product In cart</p>
                        <inertia-link :href="route('shop')"
                            class="px-14 py-3 border border-gray-500 hover:text-white hover:bg-gray-900">Shopping
                        </inertia-link>
                    </div>
                </div>
                <div v-else class="">you must be auther</div>
            </div>



            <also-like :products="alsoLike" />

        </div>
    </my-app>
</template>

<script>
    import myApp from '@/Layouts/myApp'
    import AlsoLike from '@/Shared/alsoLike'

    export default {
        components: {
            myApp,
            AlsoLike
        },
        props: {
            productInCart: Object,
            alsoLike: Object,
            totalPrice: Number
        },

        data() {
            return {
                tax: this.totalPrice * 0.21,
            }
        },

        methods: {
            deleteAll(product) {
                this.$inertia.delete(route('cart.destroy', product.id), {
                    preserveScroll: true,
                    onSuccess: res => {
                        new Noty({
                            theme: 'metroui',
                            type: 'success',
                            layout: 'topRight',
                            text: this.$page.props.flash.msg,
                            timeout: 2000,
                            killer: true
                        }).show()
                    },
                    onError: error => {

                    }
                })
            },
            deleteOne(product) {
                this.$inertia.delete(route('cart.deleteOne', product.id), {
                    preserveScroll: false,
                    onSuccess: res => {
                        new Noty({
                            theme: 'metroui',
                            type: 'success',
                            layout: 'topRight',
                            text: this.$page.props.flash.msg,
                            timeout: 2000,
                            killer: true
                        }).show()
                    },
                    onError: error => {

                    }
                })
            },
        },
        created() {
            console.log(this.productInCart);
        }
    }

</script>

<style scoped>

</style>
