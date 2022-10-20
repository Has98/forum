<template>
    <div class="border-2 md:border-t-4 sm:rounded-lg mt-3 ">
        <div v-if="replied.description" class="border-2 sm:rounded-lg ">
            <div class="grid gap-1 bg-gray-100 px-4 py-4 font-mono rounded-lg">
                <div class="flex items-center justify-between">
                    <div v-html="replied.description"></div>
                    
                </div>
            </div>
        </div>
        <div class="grid gap-1  px-4 py-4 font-mono rounded-lg">
            <div class="flex  justify-between">
                <div class="flex items-center ">
                    <img src="/img/nouser.png" style="width:30px; border-radius:50%" />
                    <span class="text-s">{{user.name}}</span>
                </div>
                <span class="text-s">{{ getDate(comment.created_at) }}</span>

            </div>
            <div class="flex items-center justify-between mt-2">
                <div v-html="comment.description"></div>
            </div>
        </div>
    </div>
    <div  class="flex justify-end">
        <like-component :obj="comment.id" :type="'comment'"></like-component>
        <CreateCommentContainer :post="post" :comment="comment"/>
    </div>
</template>
<script>
    import CreateCommentContainer from '../Comments/createCommentContainer.vue';
    import moment from "moment";
    import LikeComponent from '../Reactions/likeComponent.vue';
    export default {
        components: {
            CreateCommentContainer,
            LikeComponent
        },
        props: ['comment', 'post'],
        data: function() {
            return {
                description:'',
                show:false,
                replied:[],
                user:''
            }
        },
        methods: {
            getComments() {
                 axios.get('/comment/' +this.post.id+'/'+ this.comment.reply_id).then(response => {
                    this.replied=response.data;
                 }).catch(err=>{console.log(err)});
            },
            getUser() {
                 axios.get('/user/' +this.comment.user_id).then(response => {
                    this.user=response.data;
                 }).catch(err=>{console.log(err)});
            },
            getDate : function (date) {
               return moment(date).fromNow();
            }
        },
        created(){
            this.getComments();
            this.getUser();
        }
    }
</script>
