<template>
    <AppLayout title="Forum">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-3">
            <div class="grid gap-1  px-4 py-4 font-mono rounded-lg">
                <p class="text-xl">{{post.title}}</p>
                <span class="text-xl" v-html="post.description"></span>

                <div class="p-2 mt-2 flex items-end	 flex-col bg-gray-100">

                    <span style="color: darkgrey;">{{ getDate(post.created_at) }}</span>
                    <div  class="flex justify-end">
                        <like-component :obj="post.id" :type="'post'"></like-component>
                        <CreateCommentContainer :post ="post" :comment="comment" v-on:getcomments="getComments()"/>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <CommentsComponent :post="post" :comments="comments"/>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import CommentsComponent from '../Comments/commentsComponent.vue';
import CreateCommentContainer from '../Comments/createCommentContainer.vue';
import moment from "moment";
import LikeComponent from '../Reactions/likeComponent.vue';

    export default{
        components: {
            AppLayout,
            CommentsComponent,
            CreateCommentContainer,
            LikeComponent
        },
        props: ['post'],
        data: function() {
            return {
                comments:[]
            }
        },
        methods: {
            getComments() {
                axios.post('/comments',{post_id:this.post.id})
                .then((response)=>{
                if(response.status == 200) {
                   this.comments = response.data;
                   }
                }).catch(err=>{console.log(err)});
            },

            getDate : function (date) {
               return moment(date).fromNow();
            }
        },
        created(){
            this.getComments();
            window.Echo.channel("getcomments").listen('GetComments', e => {
               this.comments.push(e.comment)
            })
        }
    }
</script>
