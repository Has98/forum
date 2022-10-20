<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <hr>
        <p class="p-3 rounded-lg mb-3 mt-3 bg-gray-100" >Create a new Topic</p>
        <input type="text" name="title" v-model="title" class="mt-3 mb-3 g-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="What is this discussion about in one brief sentence?">
        <quill-editor placeholder="Type ..." v-model:content="description" contentType="html" theme="snow" toolbar="full"></quill-editor>
        <button @click="addNewPost()" :disabled="!this.title && !this.description"  class="mb-3 mt-3 text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+ New Topic</button>
        <hr>

    </div>
</template>
<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

    export default{
        components: {
            QuillEditor
        },
        data: function() {
            return {
                post:'',
                description:'',
                title:''
            }
        },
        methods: {
            addNewPost() {
                axios.post('/post',{title: this.title, description:this.description,user_id:this.$page.props.user.id})
                .then((response)=>{
                    if(response.status == 201) {
                        this.post=response.data.post
                        this.title=''
                        this.description=''
                        this.$emit('postcreated');
                    }
                  })
                  .catch()

            }
        }
    }


</script>
