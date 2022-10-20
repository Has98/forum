<template>
    <div class="container flex items-center  justify-end mx-1">
        <a  class="flex items-center justify-between mx-1" style="cursor: pointer" @click.prevent="like(1)">
            <img class="mx-1" src="@/img/thumb-up.png" />
            {{ alllikes }}
        </a>
        <a class="flex items-center justify-between mx-1" style="cursor: pointer" @click.prevent="like(0)">
            <img class="mx-1" src="@/img/thumb-down.png" />
            {{ allDislike }}
        </a>
    </div>
    <DialogModal :show="show" @close="closeModal">

        <template #title>
            Sign In
        </template>

        <template #footer>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
                <p class="rounded-lg mb-3 mt-3 bg-gray-100" >Please <a class="border-b-4 border-indigo-500 " :href="route('login')">Sign In</a> or <a class="border-b-4 border-indigo-500 " :href="route('register')">Register</a>.</p>
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
    export default {
        components: {
            DialogModal,
            PrimaryButton,
            SecondaryButton
        },
        props:['obj','type'],
        data() {
            return {
                alllikes: '',
                allDislike:'',
                show:false

            }
        },
        methods: {
            like(reaction){
                    if(!this.$page.props.user){
                        this.show=true
                    }else{
                        axios.post('/like/'+this.obj, {obj: this.obj,type:this.type,user:this.$page.props.user.id,reaction:reaction})
                        .then(res => {
                            this.renderLike()
                        })
                        .catch()
                    }

            },
            renderLike() {
                axios.post('/like', {obj:this.obj,type:this.type})
                .then(res => {
                    this.alllikes = res.data.obj.likes_count
                    this.allDislike = res.data.obj.dislikes_count

                })
            },
            closeModal () {
                this.show = false;
            }
        },
        mounted() {
            this.renderLike()
        }
    }
</script>
