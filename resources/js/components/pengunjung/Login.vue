<template>
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img :src="'/images/base/logobulat.png'" class="brand_logo" alt="Logo">
                </div>
            </div>
            <form class="form-group" v-on:submit.prevent="login">
                <div class="justify-content-center form_container_login login_container">
                    <h3 class="text-center">Masuk ke Akun Anda</h3>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="email" v-model="email" name="email" class="form-control input_user" placeholder="Email">
                    </div>
                    <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
                    <div class="input-group mb-1koma40">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                        </div>
                        <input type="password" v-model="password" name="password" class="form-control input_pass" placeholder="Kata Sandi">
                    </div>
                     <span v-if="errors.password" :class="['label label-danger']">{{ errors.password[0] }}</span>
                </div>
                <div class="justify-content-center mt-3 login_container" >
                    <button type="submit" class="btn btn-primary py-3 px-4" style="padding:10px">MASUK</button>
                </div>
            </form>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    Belum memiliki akun? <router-link :to="'/auth/register'"><a class="ml-2">Daftarkan Akun</a></router-link>
                </div>
                <div class="d-flex justify-content-center links">
                    <router-link :to="'/auth/resetpassword'">Lupa Kata Sandi?</router-link>
                </div>
                <div class="d-flex justify-content-center links">
                    <router-link :to="'/auth/resendtoken'">Kirim Ulang Email Verifikasi?</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SideBarProfil from './../layouts/SideBarProfil.vue'
    
    export default {
        data(){
            return{
                email: '',
                password: '',
                errors: [],
                messages: ''
            }
        },

        methods: {
            login(){
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
                axios.post('/api/login',
                {
                    email: this.email,
                    password: this.password
                })
                .then((res) => {
                    localStorage.setItem('usertoken', res.data.data.token)
                    localStorage.setItem('loggedin', "loggedin")
                    localStorage.setItem('userstatus', res.data.data.users_status)
                    this.email = ''
                    this.password = ''
                    //this.$swal({
                        //position: 'top-end',
                        //type: 'success',
                        //title: "Login Berhasil Dilakukan",
                        //showConfirmButton: false,
                        //timer: 5000,
                        //toast: true
                    //});
                    if(localStorage.getItem("urlcontinue"))
                    {
                        window.location.href = localStorage.getItem("urlcontinue")
                        localStorage.removeItem('urlcontinue')
                    }
                    else
                    {
                        if(res.data.data.users_status == "1")
                            window.location.href = '/'
                        else
                            window.location.href = '/home'
                    }
                    
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