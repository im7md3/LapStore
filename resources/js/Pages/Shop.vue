<template>
    <my-app>

        <template #Linksbreadcrumbs>
            <inertia-link :href="route('landingpage')" class="text-blue-700 font-black">Home</inertia-link> >
            <span class="font-black">Shop</span>
        </template>

        <div class="container grid grid-cols-4 py-20 gap-10">
            <sidebar></sidebar>
            <!-- end sidebar -->
            <div class=" col-span-3">
                <div class="products-header  mb-16">
                    <h1 class="relative font-black text-4xl">{{ categories[0].name }}</h1>
                </div>

                <div class="products text-center ">
                    <div v-if="products.length>0" class="grid  grid-cols-3 grid-rows-3 gap-8 place-items-center">
                        <div v-for="product in products" :key="product.id" class="product max-h-80">
                            <inertia-link :href="route('products.show',product.slug)">
                                <img :src="$page.props.asset + product.image" alt="product">
                                </inertia-link>
                            <div class="mt-5">
                                <p class="product-name">{{ product.name }}</p>
                                <p class="product-price">{{ product.price }}</p>
                            </div>
                        </div>
                    </div>
                    <div v-else style="text-align: left">No items found</div>
                </div> <!-- end products -->

            </div>
        </div>

    </my-app>
</template>

<script>
    import myApp from '@/Layouts/myApp'
    import sidebar from '@/Shared/sidebar'

    export default {
        components: {
            myApp,sidebar
        },
        props: {
            products: Object,
            categories:Object
        },
        created() {}
    }

</script>

<style scoped>

</style>
