<template>
    <div class="d-flex justify-content-center h-100">
        <div class="user_card_register">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img :src="'/images/base/logobulat.png'" class="brand_logo" alt="Logo">
                </div>
            </div>
            <form class="form-group" v-on:submit.prevent="register">
                <div class="justify-content-center form_container_login login_container">
                    <h3 class="text-center">Daftarkan Akun Anda</h3>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-book"></i> </span>
                        </div>
                        <input type="text" v-model="name" name="name" class="form-control input_user" value="" placeholder="Nama Lengkap">
                    </div>
                    <span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" v-model="email" name="email" class="form-control input_email" value="" placeholder="Email Anda">
                    </div>
                    <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input type="password" v-model="password" name="password" class="form-control input_pass" value="" placeholder="Kata Sandi">
                    </div>
                    <span v-if="errors.password" :class="['label label-danger']">{{ errors.password[0] }}</span>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                        <input type="number" v-model="nomorhp" name="nomorhp" class="form-control input_nomorhp" value="" placeholder="Nomor HP Anda">
                    </div>
                    <span v-if="errors.nomorhp" :class="['label label-danger']">{{ errors.nomorhp[0] }}</span>
                </div>
                <div class="justify-content-center mt-3 login_container" >
                    <button type="submit" name="button" class="btn btn-primary py-3 px-4" style="padding:10px">Daftar</button>
                </div>
            </form>
            <div class="mt-2">
                <div class="d-flex justify-content-center links">
                    Sudah memiliki akun? <router-link :to="'/auth/login'"><a class="ml-2">Masuk ke Akun Anda</a></router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name: '',
                email: '',
                password: '',
                nomorhp: '',
                errors: []
            }
        },

        methods: {
            register(){
                this.errors = [];
                this.$swal({
                    title: "Harap Menunggu",
                    text: "Sedang Memproses Permintaan",
                    imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                    imageHeight: 100,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                axios.post('/api/register',
                {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    nomorhp: this.nomorhp
                })
                .then((res) => {
                    this.$swal({
                        title: 'Berhasil!',
                        text: res.data.message,
                        type: 'success'
                    });
                    this.name = "";
                    this.email = "";
                    this.password = "";
                    this.nomorhp = "";
                })
                .catch((err) => {
                    this.$swal({
                        position: 'top-end',
                        type: 'error',
                        title: 'Terjadi Kesalahan Pada Inputan Anda',
                        showConfirmButton: false,
                        timer: 5000,
                        toast: true
                    });
                    this.errors = err.response.data.errors;
                })
            }
        }
    }
</script>