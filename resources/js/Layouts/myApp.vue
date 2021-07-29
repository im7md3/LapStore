<template>
    <mynav />
    <breadcrumbs >
        <template #breadcrumbs>
            <slot name="Linksbreadcrumbs"></slot>
        </template>
    </breadcrumbs>
    
        <slot></slot>
    
    <myfooter />
</template>

<script>
import mynav from '@/Shared/Nav'
import myfooter from '@/Shared/footer'
import breadcrumbs from '@/Shared/breadcrumbs'
export default {
    components:{mynav,myfooter,breadcrumbs},
    
}
</script>

<style scoped>

</style>