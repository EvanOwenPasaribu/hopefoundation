<template>
    <div class="container addpaddingtop addpaddingbottom50px">
        <div class="profile-content" style="padding-bottom:70px">
            <h2 class="text-center">Cek Tanggal Vaksin</h2>
            <h6 class="text-center">Silahkan Masukkan NIK e-KTP Untuk Melakukan Pengecekkan Tanggal Vaksin</h6>
            <hr>
            <form class="form-group" v-on:submit.prevent="cektanggalvaksin">
                <div class="form-group row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nik" v-model="nik" placeholder="Masukkan NIK e-KTP" id="statisNik" style="margin-top:10px;margin-bottom:10px">
                        <span v-if="errors.nik" :class="['label label-danger']">{{ errors.nik[0] }}</span>
                    </div>
                    <div class="col-sm-1" style="text-align:right">
                        <button type="submit" class="btn btn-primary py-3 px-4" style="width:max-content;margin-top:10px">CEK</button>
                    </div>
                </div>
            </form>
            <hr>
            <h5><b>Nama :</b> {{nama}}</h5>
            <h5><b>Tanggal Lahir :</b> {{ tanggallahir | moment("DD MMMM YYYY") }}</h5>
            <h5><b>Tanggal Vaksin Pertama :</b> {{ tanggalvaksinpertama | moment("timezone", "Asia/Bangkok", "dddd, DD MMMM YYYY") }} {{waktuvaksinpertama}}</h5>
            <h5><b>Tanggal Vaksin Kedua :</b> {{ tanggalvaksinkedua | moment("timezone", "Asia/Bangkok", "dddd, DD MMMM YYYY") }} {{waktuvaksinkedua}}</h5>
           
        </div>
    </div>
</template>

<script>
export default {
    components:{
    },
    data(){
        return{
            nik: '',
            nama: '',
            tanggallahir: '',
            tanggalvaksinpertama: '',
            tanggalvaksinkedua: '',
            waktuvaksinpertama: '',
            waktuvaksinkedua: '',
            errors: [],
        }
    },
    mounted(){
        
    },
    methods: {
        cektanggalvaksin(){
            var app = this;
            app.errors = [];
            axios.post('/api/cektanggalvaksin',
            {
                nik: app.nik
            })
            .then((res) => {
                app.nama = res.data.data.namalengkap;
                app.tanggallahir = res.data.data.tanggallahir;
                app.tanggalvaksinpertama = res.data.data.tanggalvaksinpertama;
                app.tanggalvaksinkedua = res.data.data.tanggalvaksinkedua;
                app.waktuvaksinpertama = res.data.data.waktuvaksinpertama;
                app.waktuvaksinkedua = res.data.data.waktuvaksinkedua;
            })
            .catch((err) => {
                if(err.response.data.status == 1)
                    this.messages = 'Terjadi Kesalahan Pada Inputan Anda';
                else
                    this.messages = err.response.data.message;
                app.$swal({
                    position: 'top-end',
                    type: 'error',
                    title: this.messages,
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true
                });
                app.nama = "";
                app.tanggallahir = "";
                app.tanggalvaksinpertama = "";
                app.tanggalvaksinkedua = "";
                app.waktuvaksinpertama = "";
                app.waktuvaksinkedua = "";
                if(err.response.data.status == 1)
                    app.errors = err.response.data.errors;
            })
        }
    }
}
</script>