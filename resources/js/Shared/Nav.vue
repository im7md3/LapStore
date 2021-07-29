<template>
<div class="sss">
        <div class="container">
    <div class="top-nav items-center text-sm">
                <inertia-link :href="route('landingpage')" class="logo">Laravel Ecommerce</inertia-link>
                <ul class="w-max">
                    <li><inertia-link :href="route('shop')">Shop</inertia-link></li>

                    <li v-if="!$page.props.user"><inertia-link class="mr-3" :href="route('login')">Login</inertia-link>
                    <inertia-link :href="route('register')">Register</inertia-link></li>
                    <li v-if="$page.props.user"><inertia-link href="">About</inertia-link></li>
                    <li v-if="$page.props.user"><inertia-link href="#">Blog</inertia-link></li>
                    <li v-if="$page.props.user"><inertia-link :href="route('cart.index')" class="relative">Cart<span v-if="$page.props.countCart>0" class="absolute  p-1 w-6 h-6 bg-yellow-500 text-white rounded-2xl	 -top-3 -right-6  flex items-center justify-center">{{$page.props.countCart}}</span></inertia-link></li>
                    <li v-if="$page.props.user" class="cursor-pointer" @click="logout">Logout</li>

                </ul>
                </div>
            </div> <!-- end top-nav -->
            </div>
</template>

<script>
export default {
    methods:{
      logout(){
        this.$inertia.post(route('logout'));
      }
    }
}
</script>

<style scoped>
.container {
  max-width: 950px;
  margin: auto;
}
.sss{
    background: #535353;
    color:#fff;
}
.top-nav {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  padding: 30px 0;
  
}

 .top-nav .logo {
  font-weight: bold;
  font-size: 28px;
}

 .top-nav ul {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  text-transform: uppercase;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  width: 40%;
}

 .top-nav ul a {
  color: #e9e9e9;
}

 .top-nav ul a:hover {
  color: #d0cfcf;
}
@media only screen and (max-width: 992px) {
   .top-nav {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }

   .top-nav .logo {
    margin: auto;
  }

   .top-nav ul {
    margin: 20px auto 0;
    width: 80%;
  }

}
</style>