<template>
    <div class="container addpaddingtop addpaddingbottom">
        <h2 class="text-center">Profile {{templates.app_name}}</h2>
        <hr>
        <div v-html="templates.profile_description" class="paddingtop20px text-black-100">
        </div>
    </div>
</template>

<script>
    export default{
        components:{
            
        },
        data(){
            return{
            }
        },
        props: ['templates'],
        mounted() {
            
        }
    }
    
</script>