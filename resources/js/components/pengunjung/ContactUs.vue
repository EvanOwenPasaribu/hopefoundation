<template>
    <div class="container addpaddingtop addpaddingbottom50px">
        <div class="profile-content" style="padding-bottom:70px">
            <h4 class="text-black-100"><b>Contact Us</b></h4>
            <hr>
            <form class="form-group" v-on:submit.prevent="contactus">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label text-black-100">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" v-model="email" placeholder="Email" id="staticEmail">
                        <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticName" class="col-sm-2 col-form-label text-black-100">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" v-model="name" placeholder="Nama Lengkap" id="staticName">
                        <span v-if="errors.name" :class="['label label-danger']">{{ errors.name[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticPesan" class="col-sm-2 col-form-label text-black-100">Pesan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="pesan" v-model="pesan" rows="8" placeholder="Isi Pesan" id="staticPesan"></textarea>
                        <span v-if="errors.pesan" :class="['label label-danger']">{{ errors.pesan[0] }}</span>
                    </div>
                </div>
                <div class="row project-button-without-padding float-right">
                    <button type="submit" class="btn btn-primary py-3 px-4" style="width:max-content">KIRIM</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name: '',
                email: '',
                pesan: '',
                errors: []
            }
        },
        mounted(){

        },
        methods: {
            contactus(){
                this.errors = [];
                this.$swal({
                    title: "Harap Menunggu",
                    text: "Sedang Memproses Permintaan",
                    imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                    imageHeight: 100,
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                axios.post('/api/contactus',
                {
                    name: this.name,
                    email: this.email,
                    pesan: this.pesan
                })
                .then((res) => {
                    this.$swal({
                        title: 'Berhasil!',
                        text: res.data.message,
                        type: 'success'
                    });
                    this.name = "";
                    this.email = "";
                    this.pesan = "";
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