<template>
    <div class="py-8 bg-gray-100 mt-16">
                <div class="container">
                    <h3 class="font-black mb-10 text-lg">You might also like...</h3>
                    <div class="grid grid-cols-4 gap-5">
                        <div class="bg-white text-center p-5  border border-gray-400"
                            v-for="product in products" :key="product.id">
                            <inertia-link :href="route('products.show',product.slug)"><img
                                    :src="$page.props.asset + product.image" alt=""></inertia-link>
                            <div class="mt-5">
                                <p class="font-black">{{ product.name }}</p>
                                <p class="font-black mt-2 text-gray-500">${{ product.price }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
</template>

<script>
export default {
    props:{products:Object}
}
</script>