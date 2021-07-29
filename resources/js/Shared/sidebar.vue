<template>
    <div class="sidebar col-span-1">
                <h3 class="mb-5 font-black ">By Categorys</h3>
                <ul>

                    <li class="mb-4" v-for="category in $page.props.cats" :key="category.id">
                        <inertia-link :href="route('categories.show',category.slug)">{{ category.name }}</inertia-link>
                    </li>

                </ul>
                <div>
                    <h3 class="mb-5 mt-8 font-black ">Price:</h3>
                    <ul>
                        <li class="mb-4">
                            <inertia-link href="#">Low to High</inertia-link>
                        </li>
                        <li class="mb-4">
                            <inertia-link href="#">High to Low</inertia-link>
                        </li>
                    </ul>

                </div>
            </div> 
</template>

<script>
export default {
    
}
</script>