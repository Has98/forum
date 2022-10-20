<template>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-3">
        <div class="grid gap-1  px-4 py-4 font-mono rounded-lg">
            <div class="flex items-center justify-between">
            <a :href="route('post', post.id)" class="underline text-sm text-gray-600 hover:text-gray-900">
            <span class="text-xl">{{post.title}}</span>
            </a>
                <div  class="flex items-center justify-between">
                    <div  class="flex items-center justify-between mx-1">
                        <img class="mx-1" src="@/img/comment.png" />
                        <span >{{post.comments_count}}</span>
                        <like-component :obj="post.id" :type="'post'"></like-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import LikeComponent from '../Reactions/likeComponent.vue';

    export default{
        components: {
            LikeComponent
        },
        props: ['post']
    }

</script>
