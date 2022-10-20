<template>
    <AppLayout title="Forum">
        <div class="py-12">
            <div v-if="$page.props.user">
                <CreatePostContainer v-on:postcreated="getPosts()"/>
            </div>
            <div v-else  class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
                <p class="p-3 rounded-lg mb-3 mt-3 bg-gray-100" >Please <a class="border-b-4 border-indigo-500 " :href="route('login')">Sign In</a> or <a class="border-b-4 border-indigo-500 " :href="route('register')">Register</a> to write your thoughts or comment.</p>
            </div>
            <PostsContainer :posts="posts"/>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import CreatePostContainer from './Posts/createPostContainer.vue';
import PostsContainer from './Posts/postsContainer.vue';
import { Link } from '@inertiajs/inertia-vue3';

    export default{
        components: {
            AppLayout,
            CreatePostContainer,
            PostsContainer
        },
        data: function() {
            return {
                posts:[]
            }
        },
        methods: {
            getPosts() {
                 axios.get('/posts').then(response => {
                    this.posts = response.data;
                }).catch(err=>{console.log(err)});
            },

        },
        created(){
            this.getPosts();
            window.Echo.channel("postcreated").listen('NewPost', e => {
               this.posts.push(e.post)
            })
        }
    }


</script>
