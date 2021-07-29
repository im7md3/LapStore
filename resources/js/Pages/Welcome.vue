<template>
<my-app>
        <header>
            
          
            <div class="hero container">
                <div class="hero-copy">
                    <h1>Laravel Ecommerce</h1>
                    <p>A practical example of using CSS Grid for a typical website layout.</p>
                    <div class="hero-buttons">
                        <a href="#" class="button button-white">Button 1</a>
                        <a href="#" class="button button-white">Button 2</a>
                    </div>
                </div> <!-- end hero-copy -->

                <div class="hero-image">
                    <img src="img/macbook-pro-laravel.png" alt="hero image">
                </div>
            </div> <!-- end hero -->
        </header>

        <div class="featured-section">
            <div class="container">
                <h1 class="text-center">CSS Grid Example</h1>

                <p class="section-description text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquid earum fugiat debitis nam, illum vero, maiores odio exercitationem quaerat. Impedit iure fugit veritatis cumque quo provident doloremque est itaque.</p>

                <div class="text-center button-container">
                    <a href="#" class="button">Featured</a>
                    <a href="#" class="button">On Sale</a>
                </div>


                <div class="products text-center">
                    <div v-for="product in products" :key="product.id" class="product">
                        <inertia-link :href="route('products.show',product.slug)">
                          <img :src="$page.props.asset + product.image" alt="product">
                          </inertia-link>
                        <div class="product-name">{{product.name}}</div>
                        <div class="product-price">${{product.price}}</div>
                    </div>
                    
                </div> <!-- end products -->

                <div class="text-center button-container">
                    <inertia-link :href="route('shop')" class="button">View more products</inertia-link>
                </div>

            </div> <!-- end container -->

        </div> <!-- end featured-section -->

        <div class="blog-section">
            <div class="container">
                <h1 class="text-center">From Our Blog</h1>

                <p class="section-description text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et sed accusantium maxime dolore cum provident itaque ea, a architecto alias quod reiciendis ex ullam id, soluta deleniti eaque neque perferendis.</p>

                <div class="blog-posts">
                    <div class="blog-post" id="blog1">
                        <inertia-link href=""><img src="img/blog1.png" alt="blog image"></inertia-link>
                        <inertia-link href=""><h2 class="blog-title">Blog Post Title 1</h2></inertia-link>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est ullam, ipsa quasi?</div>
                    </div>
                    <div class="blog-post" id="blog2">
                        <a href="#"><img src="img/blog2.png" alt="blog image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 2</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est ullam, ipsa quasi?</div>
                    </div>
                    <div class="blog-post" id="blog3">
                        <a href="#"><img src="img/blog3.png" alt="blog image"></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 3</h2></a>
                        <div class="blog-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est ullam, ipsa quasi?</div>
                    </div>
                </div> <!-- end blog-posts -->
            </div> <!-- end container -->
        </div> <!-- end blog-section -->

</my-app>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import myfooter from '@/Shared/footer'
    import mynav from '@/Shared/Nav'
    import myApp from '@/Layouts/myApp'
    
    export default {
        components: {
            AppLayout,
            Welcome,
            myfooter,
            mynav,
            myApp
        },
        props: {
            products:Object
        }
    }
</script>

<style scoped>
a {
  text-decoration: none;
  color: #212121;
}

a:visited {
  color: #212121;
}

h1,
h2 {
  font-family: 'Montserrat', Arial, sans-serif;
  font-weight: bold;
}

h1 {
  font-size: 38px;
  margin-bottom: 40px;
}

h2 {
  font-size: 22px;
  margin-bottom: 10px;
}

img {
  max-width: 100%;
}

.text-center {
  text-align: center;
}


.button {
  border: 1px solid #212121;
  padding: 12px 40px;
}

.button:hover {
  color: #e9e9e9;
  background: #212121;
}

.button-white {
  border: 1px solid #e9e9e9;
  color: #e9e9e9 !important;
}

.button-white:hover {
  color: #212121 !important;
  background: #e9e9e9;
}

.section-description {
  width: 80%;
  margin: auto;
}

.button-container {
  margin: 80px 0;
}
header {
  background: url("/img/triangles.svg");
  background-size: cover;
  color: white;
}

header .top-nav {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  padding: 40px 0;
}

header .top-nav .logo {
  font-weight: bold;
  font-size: 28px;
}

header .top-nav ul {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  text-transform: uppercase;
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
  width: 40%;
}

header .top-nav ul a {
  color: #e9e9e9;
}

header .top-nav ul a:hover {
  color: #d0cfcf;
}

.hero {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 30px;
  padding-top: 20px;
  padding-bottom: 84px;
}

.hero .hero-image {
  padding-left: 60px;
}

.hero h1 {
  font-size: 46px;
  margin-top: 50px;
}

.hero p {
  margin: 40px 0 68px;
}

.hero .button {
  margin-right: 14px;
}

.featured-section {
  padding: 50px 0;
}

.featured-section .products {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  grid-gap: 30px;
}

.blog-section {
  background: #F5F5F5;
  border-top: 1px solid #CDCDCD;
  padding: 50px 0;
}

.blog-section .blog-posts {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 30px;
  margin: 60px 0 60px;
  grid-template-areas: "blog1 blog2 blog3";
}

.blog-section .blog-posts #blog1 {
  grid-area: blog1;
}

.blog-section .blog-posts #blog2 {
  grid-area: blog2;
}

.blog-section .blog-posts #blog3 {
  grid-area: blog3;
}




/* Medium Devices, Desktops */

@media only screen and (max-width: 992px) {
  header .top-nav {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }

  header .top-nav .logo {
    margin: auto;
  }

  header .top-nav ul {
    margin: 20px auto 0;
    width: 80%;
  }

  header .hero {
    grid-template-columns: 1fr;
    text-align: center;
  }

  header .hero .hero-image {
    padding-left: 0;
    margin-top: 40px;
  }

  .featured-section {
    padding: 50px 0;
  }

  .featured-section .products {
    grid-template-columns: 1fr;
  }

  .blog-section .blog-posts {
    grid-template-columns: 1fr;
    text-align: center;
    grid-template-areas: "blog1" "blog2" "blog3";
  }


}


</style>          