<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p class="text-3xl mt-3 text-center p-3" style="background-color:#6875f5;color:#fff">Welcome to our community! These are the most popular recent topics.</p>
        <div v-for="(post,index) in posts" :key="index">
            <PostContainer :post="post" />
        </div>
    </div>
</template>
<script>
import PostContainer from './postContainer.vue';
    export default{
        components: {PostContainer},
        props: ['posts']
    }
</script>
