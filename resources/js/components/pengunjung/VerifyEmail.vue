<template>
    <div class="container addpaddingtop addpaddingbottom">
        <h2 class="text-center">Proses Verifikasi</h2>
        <hr>
        <h5 class="text-center">{{messages}}</h5>
        <br>
        <br>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                path: this.$route.params.token,
                messages: ''
            }
        },
        mounted() {
            this.checkVerify()
        },
        methods:{
            checkVerify() {
                var app = this;
                axios.get('/api/verifyemail/' + app.path).then(function (res) {
                    app.messages = res.data.message
                })
                .catch(function (res) {
                    app.messages = res.data.message
                });
            },
        }
    }
</script>

