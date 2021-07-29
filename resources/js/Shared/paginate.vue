<template>
    <div class="">
        <ul class="flex">
            <li></li>
            <li  v-for="(link,index) in this.myData.links" :key="index">
                <inertia-link :href="link.url"  class="text-blue-500"
                :class="[ link.url === null ? 'hidden':'',]">
                    <span class="py-2 px-4 border border-blue-500 bg-white  hover:bg-blue-500 hover:text-white"  :class="[link.active===true?'bg-blue-500 text-white':'']" v-html="link.label"></span>
                </inertia-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props:{myData:Object}
}
</script>