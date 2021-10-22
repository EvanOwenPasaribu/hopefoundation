<template>
    <div class="d-flex justify-content-center h-100">
        <div class="user_card_resend">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img :src="'/images/base/logobulat.png'" class="brand_logo" alt="Logo">
                </div>
            </div>
            <form class="form-group" v-on:submit.prevent="reset">
                <div class="justify-content-center form_container_resend login_container">
                    <h3 class="text-center">Lupa Kata Sandi</h3>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" v-model="email" name="email" class="form-control input_user" placeholder="Email">
                    </div>
                    <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
                </div>
                <div class="justify-content-center mt-3 login_container" >
                    <button type="submit" class="btn btn-primary py-3 px-4" style="padding:10px">KIRIM</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            email: '',
            errors: [],
            messages: ''
        }
    },

    methods: {
        reset(){
            this.errors = [];
            this.messages = '';
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/resetpassword',
            {
                email: this.email,
            })
            .then((res) => {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.email = "";
            })
            .catch((err) => {
                this.errors = err.response.data.errors;
                if(err.response.data.status == 1)
                    this.messages = 'Terjadi Kesalahan Pada Inputan Anda';
                else
                    this.messages = err.response.data.message;
                this.$swal({
                    position: 'top-end',
                    type: 'error',
                    title: this.messages,
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true
                });
            })
        }
        
    }
}
</script>