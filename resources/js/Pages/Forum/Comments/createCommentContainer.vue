<template>
    <SecondaryButton @click="createComment">
        Reply
    </SecondaryButton>
    <DialogModal :show="show" @close="closeModal">
        <template v-if="comment" #title>
            Reply to
            <div class="border-2 md:border-t-4 sm:rounded-lg mt-3 ">
                <div class="grid gap-1  px-4 py-4 font-mono rounded-lg">
                    <div class="flex items-center justify-between">
                        <div v-html="comment.description"></div>
                    </div>
                </div>
            </div>
        </template>
        <template v-else #title>
            Write your comment here
        </template>
        <template #content>
            <div class="mt-4">
                <quill-editor v-model:content="description" contentType="html" theme="snow" toolbar="full"></quill-editor>
            </div>
        </template>
        <template #footer>
            <div v-if="$page.props.user">
                <PrimaryButton mr-3 :disabled="!this.description" @click="addNewComment">Reply</PrimaryButton>
            </div>
            <div v-else  class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
                <p class="rounded-lg mb-3 mt-3 bg-gray-100" >Please <a class="border-b-4 border-indigo-500 " :href="route('login')">Sign In</a> or <a class="border-b-4 border-indigo-500 " :href="route('register')">Register</a> to comment.</p>
            </div>
            <SecondaryButton @click="closeModal">
                Cancel
            </SecondaryButton>
        </template>
    </DialogModal>

</template>
<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

    export default{
        components: {
            DialogModal,
            PrimaryButton,
            SecondaryButton,
            QuillEditor
        },
        props: ['post','comment'],

        data: function() {
            return {
                description:'',
                show:false
            }
        },
        methods: {
            addNewComment() {
                let comment_id=this.comment?this.comment.id:0
                axios.post('/comment',{description:this.description,user_id:this.$page.props.user.id,post_id:this.post.id,reply_id:comment_id})
                .then((response)=>{
                console.log(response)
                    if(response.status == 201) {
                        this.description=''
                        this.closeModal();
                        this.$emit('getcomments');
                        window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);

                    }
                  })
                  .catch()

            },
            createComment(){
               this.show = true;
           },
           closeModal () {
               this.show = false;
           }

        }
    }


</script>
