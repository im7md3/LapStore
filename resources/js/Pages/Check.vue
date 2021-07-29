<template>
    <my-app>
        <template #Linksbreadcrumbs>
            <inertia-link :href="route('landingpage')" class="text-blue-700 font-black">Home</inertia-link> >
            <inertia-link :href="route('cart.index')" class="text-blue-700 font-black">Shopping Cart</inertia-link> >
            <span class="font-black">Checkout</span>
        </template>
        <div class="mt-20">
            <div class="container">
                <h1 class="text-3xl font-black mb-5">Checkout</h1>

                <div class="grid grid-cols-2 gap-14">

                    <div class="col-1">

                        <form :action="route('checkout.credit-card')" method="post" id="payment-form">
                            <h3 class="font-black mb-5">Billing Details</h3>
                            <div class="form-group mb-5">
                                <label for="" class="block">Email Address</label>
                                <input type="email" class="block w-full shadow" id="email" name="email">
                            </div>

                            <div class="form-group mb-5">
                                <label for="" class="block">Name</label>
                                <input type="text" class="block w-full shadow" id="name" name="name">
                            </div>

                            <div class="form-group mb-5">
                                <label for="" class="block">Address</label>
                                <input type="text" class="block w-full shadow" id="address" name="address">
                            </div>

                            <div class="grid grid-cols-2 gap-5">
                                <div class="form-group mb-5">
                                    <label for="" class="block">City</label>
                                    <input type="text" class="block w-full shadow" id="city" name="city">
                                </div>
                                <div class="form-group mb-5">
                                    <label for="" class="block">Province</label>
                                    <input type="text" class="block w-full shadow" id="province" name="province">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-5">
                                <div class="form-group mb-5">
                                    <label for="" class="block">Postal Code</label>
                                    <input type="text" class="block w-full shadow" id="postcode" name="postalcode">
                                </div>
                                <div class="form-group mb-5">
                                    <label for="" class="block">Phone</label>
                                    <input type="text" class="block w-full shadow" id="phone" name="phone">
                                </div>
                            </div>

                            <h3 class="font-black mb-5 mt-10">Payment Details</h3>

                            <div class="form-group mb-5">
                                <label for="" class="block">Name On Card</label>
                                <input type="text" class="block w-full shadow" id="name_on_card" name="name_on_card"  v-model="form.nameCard">
                            </div>
                            <input type="hidden" name="_token" v-bind:value="csrf">
                            <input type="hidden" name="total" :value=" totalPrice + tax -(totalPrice + tax)*0.1 ">
                            <div class="form-group">
                                <label for="card-element">
                                    Credit or debit card
                                </label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>

                                <div id="card-errors" role="alert"></div>
                            </div>
                            

                            <button type="submit" id="complete-order" class="px-14 py-3 border border-gray-500 hover:text-white hover:bg-gray-900 mt-5">Complete
                                Order</button>
                        </form>


                    </div>

                    <div class="col-2">
                        <h3 class="font-black mb-5">Your Order</h3>
                        <div class="">
                            <div class="grid grid-cols-12 gap-5 border-b border-gray-200 p-3 shadow mb-2 place-items-center rounded-lg"
                                v-for="product in productInCart" :key="product.id">
                                <inertia-link :href="route('products.show',product.slug)" class="col-span-3 ">
                                    <img :src="$page.props.asset + product.image" alt="">
                                </inertia-link>
                                <div class="col-span-7 place-self-start">
                                    <p class="font-black">{{ product.name }}</p>
                                    <p class="font-black mt-2 text-gray-500 text-sm	">{{ product.details }}</p>
                                    <p class="font-black mt-2 text-sm	">${{ product.price }}</p>
                                </div>
                                <div class="col-span-2 p-2 border border-gray-500 ">
                                    {{ product.pivot.number }}
                                </div>
                            </div>
                        </div>
                        <div class=" p-5 flex shadow-lg mt-5 bg-green-400 rounded">

                            <div class=" flex w-full justify-between">
                                <div class="">
                                    <p class="text-xs mb-3">Subtotal</p>
                                    <p class="text-xs mb-3">Tax</p>
                                    <p class="text-xs mb-3" v-if="$page.props.flash.code">
                                        Discount({{ $page.props.flash.code }})</p>
                                    <p class="text-xs mb-3" v-else>Discount({{ "10%" }})</p>
                                    <p class="font-black mt-2">Total</p>
                                </div>
                                <div class="">
                                    <p class="text-xs mb-3">${{ totalPrice }}</p>
                                    <p class="text-xs mb-3">${{ tax }}</p>
                                    <p class="text-xs mb-3" v-if="discount">${{ discount }}</p>
                                    <p class="text-xs mb-3" v-else>${{ discount }}</p>
                                    <p class="font-black mt-2">
                                        ${{ totalPrice + tax -discount }}</p>
                                </div>
                            </div>
                        </div>

                        <p class="mt-8 mb-4">Have a Code?</p>
                        <div class="border border-gray-500 p-3 mb-10 shadow-lg">
                            <form action="" class=" flex justify-center">
                                <input type="text" class="py-3" v-model="formCoupon.coupon">
                                <input @click.prevent="addCoupon" value="Apply"
                                    class="cursor-pointer px-8 py-3  w-3/12	hover:bg-gray-800 hover:text-white border border-gray-400 bg-white rounded">
                            </form>
                        </div>

                    </div>

                </div>

            </div>
            <also-like :products="alsoLike" />
        </div>
    </my-app>
</template>

<script>
    import myApp from '@/Layouts/myApp'
    import AlsoLike from '@/Shared/alsoLike'
    import {
        Inertia
    } from '@inertiajs/inertia'
    export default {
        components: {
            myApp,
            AlsoLike
        },
        props: {
            productInCart: Object,
            alsoLike: Object,
            totalPrice: Number,
            intent: String,

        },
        data() {
            return {
                stripe_key: "pk_test_51Ig42vK2qaZSidyMiP0vKjOKJgIXagcYs5YXMS32QqKxfYA7pkpWeH6B4uUYWaCZPmD0nQ6tF8OshF5NztgIMKrW00J3oLIO4A",
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                tax: this.totalPrice * 0.21,
                discount: '',
                formCoupon: Inertia.form({
                    coupon: "",
                }),
                form: Inertia.form({
                    email: "",
                    name: "",
                    address: "",
                    city: "",
                    prov: "",
                    code: "",
                    phone: "",
                    nameCard: "",
                    addressCard: '',
                    cardNum: '',
                    expiry: '',
                    cvcCode: ''
                })
            }
        },
        computed: {
            changeDis() {
                if (this.$page.props.flash.discount) {
                    this.discount = this.$page.props.flash.discount;
                } else {
                    this.discount = (this.totalPrice + this.tax) * 0.1
                }

            },

        },

        methods: {
            addCoupon() {
                this.formCoupon.post(route('addcoupon'), {
                    preserveScroll: true,
                    onSuccess: res => {
                        this.changeDis;
                        this.formCoupon.reset();
                    }
                });
            },

            check() {

            }

        },

        mounted() {
            this.changeDis;
            var stripe = Stripe(this.stripe_key);
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });
            card.mount('#card-element');
            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                document.getElementById('complete-order').disabled = true;
                var options = {
                    name: document.getElementById('name_on_card').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_state: document.getElementById('province').value,
                    address_zip: document.getElementById('postcode').value
                }

                stripe.createToken(card, options).then(function (result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        document.getElementById('complete-order').disabled = false;
                    } else {
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }

        },

        created() {
            console.log(this.intent);
        }
    }

</script>
