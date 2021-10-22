<template>
    <div class="d-flex justify-content-center h-100">
        <div class="user_card_resend">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img :src="'/images/base/logobulat.png'" class="brand_logo" alt="Logo">
                </div>
            </div>
            <form class="form-group" v-on:submit.prevent="resetchangepassword">
                <div class="justify-content-center form_container_resend login_container">
                    <h3 class="text-center">Ubah Kata Sandi</h3>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input type="password" v-model="password" name="password" class="form-control input_user" placeholder="Kata Sandi Baru">
                    </div>
                    <span v-if="errors.password" :class="['label label-danger']">{{ errors.password[0] }}</span>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input type="password" v-model="password_confirmation" name="password_confirmation" class="form-control input_user" placeholder="Ulang Kata Sandi">
                    </div>
                    <span v-if="errors.password_confirmation" :class="['label label-danger']">{{ errors.password_confirmation[0] }}</span>
                </div>
                <div class="justify-content-center mt-3 login_container" >
                    <button type="submit" class="btn btn-primary py-3 px-4" style="padding:10px">KIRIM</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import GlobalMethod from './../admin/mixins/globalmethod'
export default {
    mixins: [ GlobalMethod ],
    data(){
        return{
            path: this.$route.params.tokenresetpassword,
            password: '',
            password_confirmation: '',
            errors: ''
        }
    },
    mounted() {
        
    },
    methods:{
        resetchangepassword(){
            this.errors = [];
            let bodyParameters = new FormData();
            bodyParameters.append('password',this.password);
            bodyParameters.append('password_confirmation', this.password_confirmation);

            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/resetpassword/' + this.path,
            {
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then((res) => {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.$router.push({ name: 'login' })
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>

