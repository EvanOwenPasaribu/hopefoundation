<template>
    <div class="container addpaddingtop addpaddingbottom50px">
        <div class="profile-content" style="padding-bottom:70px">
            <div class="row" style="margin-bottom:20px">
                <div class="col-3" style="padding-top:10px">
                    <center>
                        <img :src="'/images/vaksinlogo/logo2.jpg'" style="width:100%;"/>
                    </center>
                </div>
                <div class="col-1">
                </div>
                <div class="col-4">
                    <center>
                        <img :src="'/images/vaksinlogo/hopelogo.jpg'" style="width:80%;"/>
                    </center>
                </div>
                <div class="col-1">
                </div>
                <div class="col-3" style="padding-top:10px">
                    <center>
                        <img :src="'/images/vaksinlogo/logo3.jpg'" style="width:100%;"/>
                    </center>
                </div>
            </div>
            <div class="row" style="margin-bottom:20px">
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
                <div class="col-1">
                </div>
            </div>
            <h4 class="text-black-100" style="text-align:justify"><b>FORM PENDAFTARAN VAKSINASI.</b></h4> 
            <h5><b>Lokasi: Gedung Pangkalan Udara Soewondo (Ex Bandara Polonia), Medan</b></h5>
            <hr>
            <form class="form-group" v-on:submit.prevent="vaksinisasi">
                <div class="form-group row">
                    <label for="pilihan_kota" class="col-sm-4 col-form-label text-black-100">Pilihan Kota <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <select class="form-control" name="pilihan_kota" v-model="pilihan_kota" id="pilihan_kota">
                            <option value="" disabled selected>Pilih Kota Tempat Vaksin</option>
                            <option v-for="(item, idx) in kotas" :key="idx" :value="item.id_kota" :disabled="item.is_active == 'N'">
                            {{ item.namakota }} <!--({{ item.tanggalvaksin | moment("timezone", "Asia/Bangkok", "dddd, DD MMMM YYYY") }}-{{ item.tanggalvaksinselesai | moment("timezone", "Asia/Bangkok", "dddd, DD MMMM YYYY") }})-->
                            </option>
                        </select>
                        <span v-if="errors.pilihan_kota" :class="['label label-danger']">{{ errors.pilihan_kota[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label text-black-100">E-mail</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="email" v-model="email" placeholder="E-mail" id="staticEmail">
                        <span v-if="errors.email" :class="['label label-danger']">{{ errors.email[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticNamaLengkap" class="col-sm-4 col-form-label text-black-100">Nama Lengkap (Sesuai e-KTP) <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="namalengkap" v-model="namalengkap" placeholder="Nama Lengkap" id="staticNamaLengkap">
                        <span v-if="errors.namalengkap" :class="['label label-danger']">{{ errors.namalengkap[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticNIK" class="col-sm-4 col-form-label text-black-100">NIK e-KTP <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="nik" v-model="nik" placeholder="Nomor Induk Kependudukan (NIK e-KTP)" id="staticNIK">
                        <span v-if="errors.nik" :class="['label label-danger']">{{ errors.nik[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ktp_foto" class="col-sm-4 col-form-label text-black-100">Foto e-KTP <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <input type="file" class="foto form-control" name="ktp_foto" v-on:change="onImageChange" id="ktp_foto" ref="myFileInput"/>
                        <span v-if="errors.ktp_foto" :class="['label label-danger']">{{ errors.ktp_foto[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-4 col-form-label text-black-100">Jenis Kelamin <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <select class="form-control" name="jenis_kelamin" v-model="jenis_kelamin" id="jenis_kelamin">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span v-if="errors.jenis_kelamin" :class="['label label-danger']">{{ errors.jenis_kelamin[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticKotaKelahiran" class="col-sm-4 col-form-label text-black-100">Kota Kelahiran <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="kotakelahiran" v-model="kotakelahiran" placeholder="Kota Kelahiran" id="staticKotaKelahiran">
                        <span v-if="errors.kotakelahiran" :class="['label label-danger']">{{ errors.kotakelahiran[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticTanggalLahir" class="col-sm-4 col-form-label text-black-100">Tanggal Lahir <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <date-picker input-class=" form-control" type="date" format="YYYY-MM-DD" lang="en" width="100%" v-model="tanggallahir" id="staticTanggalLahir" confirm :not-after="disabledAfter" :editable="false"></date-picker>
                        <span v-if="errors.tanggallahir" :class="['label label-danger']">{{ errors.tanggallahir[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticAlamat" class="col-sm-4 col-form-label text-black-100">Alamat Tempat Tinggal <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="alamat" v-model="alamat" placeholder="Alamat Tempat Tinggal" id="staticAlamat"></textarea>
                        <span v-if="errors.alamat" :class="['label label-danger']">{{ errors.alamat[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticNomorHP" class="col-sm-4 col-form-label text-black-100">Nomor Handphone <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="nomorhpvaksin" v-model="nomorhpvaksin" placeholder="Nomor Handphone" id="staticNomorHP">
                        <span v-if="errors.nomorhpvaksin" :class="['label label-danger']">{{ errors.nomorhpvaksin[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticNomorWA" class="col-sm-4 col-form-label text-black-100">Nomor Whatsapp <font style="color:red">*</font></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="nomorwavaksin" v-model="nomorwavaksin" placeholder="Nomor Whatsapp" id="staticNomorWA">
                        <span v-if="errors.nomorwavaksin" :class="['label label-danger']">{{ errors.nomorwavaksin[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="golongan_darah" class="col-sm-4 col-form-label text-black-100">Golongan Darah (Jika Diketahui)</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="golongan_darah" v-model="golongan_darah" id="golongan_darah">
                            <option value="" disabled selected>Pilih Golongan Darah</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                        <span v-if="errors.golongan_darah" :class="['label label-danger']">{{ errors.golongan_darah[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="rhesus_darah" class="col-sm-4 col-form-label text-black-100">Rhesus Darah (Jika Diketahui)</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="rhesus_darah" v-model="rhesus_darah" id="rhesus_darah">
                            <option value="" disabled selected>Pilih Rhesus Darah</option>
                            <option value="+">+</option>
                            <option value="-">-</option>
                        </select>
                        <span v-if="errors.rhesus_darah" :class="['label label-danger']">{{ errors.rhesus_darah[0] }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticKodePendaftaran" class="col-sm-4 col-form-label text-black-100">Kota Pendaftaran (Jika Ada)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="kodependaftaran" v-model="kodependaftaran" placeholder="Kode Pendaftaran" id="staticKodePendaftaran">
                        <span v-if="errors.kodependaftaran" :class="['label label-danger']">{{ errors.kodependaftaran[0] }}</span>
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
import DatePicker from 'vue2-datepicker'
import moment from 'moment'
export default {
    components:{
        'DatePicker': DatePicker
    },
    data(){
        return{
            disabledAfter: new Date(),
            kotas: [],
            pilihan_kota: '',
            email: '',
            namalengkap: '',
            nik: '',
            foto: '',
            jenis_kelamin: '',
            kotakelahiran: '',
            tanggallahir: '',
            alamat: '',
            nomorhpvaksin: '',
            nomorwavaksin: '',
            golongan_darah: '',
            rhesus_darah: '',
            kodependaftaran: '',
            errors: [],
            messages: ''

        }
    },
    mounted(){
        this.getKota();
    },
    methods: {
        moment: function () {
            return moment();
        },
        getKota(){
            var app = this;
            axios.get('/api/kotas').then(function (res) {
                app.kotas = res.data.data
            })
            .catch(function (res) {
                console.log(res);
            });
        },
        vaksinisasi(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('pilihan_kota',this.pilihan_kota);
            bodyParameters.append('email', this.email);
            bodyParameters.append('namalengkap', this.namalengkap);
            bodyParameters.append('nik', this.nik);
            bodyParameters.append('ktp_foto', this.foto);
            bodyParameters.append('jenis_kelamin', this.jenis_kelamin);
            bodyParameters.append('kotakelahiran', this.kotakelahiran);
            bodyParameters.append('tanggallahir', moment(this.tanggallahir).format('YYYY-MM-DD'));
            bodyParameters.append('alamat', this.alamat);
            bodyParameters.append('nomorhpvaksin', this.nomorhpvaksin);
            bodyParameters.append('nomorwavaksin', this.nomorwavaksin);
            bodyParameters.append('golongan_darah', this.golongan_darah);
            bodyParameters.append('rhesus_darah', this.rhesus_darah);
            bodyParameters.append('kodependaftaran', this.kodependaftaran);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/vaksinasi',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.pilihan_kota = "";
                this.email = "";
                this.namalengkap = "";
                this.nik = "";
                this.foto = "";
                this.jenis_kelamin = "";
                this.kotakelahiran = "";
                this.tanggallahir = "";
                this.alamat = "";
                this.nomorhpvaksin = "";
                this.nomorwavaksin = "";
                this.golongan_darah = "";
                this.rhesus_darah = "";
                this.kodependaftaran = "";
                this.$refs.myFileInput.value = '';
            })
            .catch((err) => {
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
                this.errors = err.response.data.errors;
            })
        },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.foto = e.target.files[0];
        },
    }
}
</script>