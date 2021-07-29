<template>
    <my-app>

        <template #Linksbreadcrumbs>
            <inertia-link :href="route('landingpage')" class="text-blue-700 font-black">Home</inertia-link> >
            <inertia-link :href="route('shop')" class="text-blue-700 font-black">Shop</inertia-link> >
            <span class="font-black">{{ product[0].name }}</span>
        </template>
        <div class="my-20">
            <div class="container ">

                <div class="grid grid-cols-2 gap-20 ">

                    <div class="border border-gray-300 place-self-center">
                        <img class="p-28 w-full" :src="$page.props.asset + product[0].image" alt="">

                    </div>

                    <div class="">
                        <h1 class="font-black text-4xl">{{ product[0].name }}</h1>
                        <p class="mt-10 mb-3 font-black text-gray-400 text-sm">{{ product[0].details }}</p>
                        <p class="font-black text-4xl mb-7">${{ product[0].price }}</p>
                        <p class="text-base  text-gray-900 mb-16">{{ product[0].description }}</p>
                        <button @click="addToCart" class="px-14 py-3 border border-gray-500 hover:text-white hover:bg-gray-900 ">Add
                            to cart</button>
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

    export default {
        components: {
            myApp,
            AlsoLike
        },
        props: {
            product: Object,
            alsoLike: Object
        },
        methods:{
            addToCart(){
                this.$inertia.post(route('cart.store'),{product_id:this.product[0].id},{
                    preserveScroll: false,
                    onSuccess:res=>{
                        if(this.$page.props.flash.status==='false'){
                            new Noty({
                            theme: 'metroui',
                            type: 'error',
                            layout: 'topRight',
                            text: this.$page.props.flash.msg,
                            timeout: 2000,
                            killer: true
                        }).show()
                        }else{
                        new Noty({
                            theme: 'metroui',
                            type: 'success',
                            layout: 'topRight',
                            text: this.$page.props.flash.msg,
                            timeout: 2000,
                            killer: true
                        }).show()}
                    },
                    onError:error=>{
                        
                    }
                });
            }
        },

        created(){
            console.log(this.$page.props.flash.msg);
            console.log(this.$page.props.flash.status);
        }
    }

</script>

<style scoped>

</style>
