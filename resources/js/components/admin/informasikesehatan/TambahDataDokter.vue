<template>
    <div class="wrapper-nav-side">
        <h3><b>Tambah Data Dokter</b></h3>
        <form class="form-group" v-on:submit.prevent="tambahdatadokter">
            <div class="form-group row">
                <label for="namadokter" class="col-sm-2 col-form-label text-black-100">Nama Dokter</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="namadokter" v-model="namadokter" placeholder="dr. Wie Chen" id="namadokter">
                    <span v-if="errors.namadokter" :class="['label label-danger']">{{ errors.namadokter[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="rumahsakits" class="col-sm-2 col-form-label text-black-100">Tempat Praktek</label>
                <div class="col-sm-10">
                    <select class="form-control" name="rumah_sakits" v-model="rumah_sakits">
                        <option value="" disabled selected>Pilih Rumah Sakit/Klinik</option>
                        <option v-for="(item, idx) in rumahsakits" :key="idx" :value="item.id_rumahsakit">
                            {{ item.namarumahsakit }}
                        </option>
                    </select>
                    <span v-if="errors.rumah_sakits" :class="['label label-danger']">{{ errors.rumah_sakits[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="spesialist" class="col-sm-2 col-form-label text-black-100">Spesialist</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="spesialist" v-model="spesialist" placeholder="Spesialist Mata (Sp. M)" id="spesialist"></textarea>
                    <span v-if="errors.spesialist" :class="['label label-danger']">{{ errors.spesialist[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="editor" class="col-sm-2 col-form-label text-black-100">Jadwal Praktek</label>
                <div class="col-sm-10">
                    <vue-editor id="editor" class="text-black-100 backgroundwhite" v-model="jadwalpraktek" placeholder="Senin Pagi (10:00-12:00)" :editorToolbar="customToolbar"></vue-editor>
                </div>
                <div class="row" style="width:100%;margin:0px;">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <span v-if="errors.jadwalpraktek" :class="['label label-danger']">{{ errors.jadwalpraktek[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="dokter_foto" class="col-sm-2 col-form-label text-black-100">Foto Dokter</label>
                <div class="col-sm-10">
                    <input type="file" class="foto form-control" name="dokter_foto" v-on:change="onImageChange" id="dokter_foto" ref="myFileInput"/>
                    <span v-if="errors.dokter_foto" :class="['label label-danger']">{{ errors.dokter_foto[0] }}</span>
                </div>
            </div>
            <div class="row project-button-without-padding float-right">
                <button type="submit" class="btn btn-primary py-3 px-4" style="width:max-content">KIRIM</button>
            </div>
        </form>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import GlobalMethod from './../mixins/globalmethod'

export default {
    mixins: [ GlobalMethod ],
    components:{
        'VueEditor': VueEditor
    },
    data(){
        return{
            rumahsakits: [],
            rumah_sakits: '',
            namadokter: '',
            spesialist: '',
            jadwalpraktek: '',
            foto: '',
            errors: [],
            customToolbar: [["bold", "italic","underline"]]
        }
    },

    mounted() {
        this.getRumahSakit()
    },
    methods: {
        getRumahSakit(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/rumahsakits',config).then((res) => 
            {
                app.rumahsakits = res.data.data
                
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.foto = e.target.files[0];
        },
        tambahdatadokter(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('rumah_sakits',this.rumah_sakits);
            bodyParameters.append('namadokter', this.namadokter);
            bodyParameters.append('spesialist', this.spesialist);
            bodyParameters.append('jadwalpraktek', this.jadwalpraktek);
            bodyParameters.append('dokter_foto', this.foto);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/dokters/add',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.rumah_sakits = "";
                this.namadokter = "";
                this.spesialist = "";
                this.jadwalpraktek = "";
                this.foto = "";
                this.$refs.myFileInput.value = '';
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>