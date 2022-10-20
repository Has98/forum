<template>
    <div class=" overflow-hidden shadow-xl sm:rounded-lg mt-3 divide-y-4  divide-blue-400/50 ">
        <div v-for="(comment,index) in comments" :key="index" class="bg-white  grid gap-1 px-4 py-4 font-mono rounded-lg">
            <CommentContainer :post = "post" :comment="comment" />
        </div>
    </div>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import CommentContainer from './commentContainer.vue';

    export default{
        components: {
            AppLayout,
            CommentContainer
        },
        props: ['comments','post'],
    }

</script>
