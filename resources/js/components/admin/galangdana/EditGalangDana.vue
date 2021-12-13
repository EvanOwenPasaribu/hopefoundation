<template>
    <div class="wrapper-nav-side">
        <div class="profile-content" style="background:none">
            <div class="stepwizard offset-md-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" class="btn btn-primary btn-circle disableda">1</a>
                        <p>Info Penggalangan</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" class="btn btn-default btn-circle disableda">2</a>
                        <p>Cerita Penggalangan</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" class="btn btn-default btn-circle disableda">3</a>
                        <p>Konfirmasi</p>
                    </div>
                </div>
            </div>
            <form role="form" action="" v-on:submit.prevent="postcampaign" enctype= multipart/form-data>
                <div class="row setup-content" id="step-1">
                    <div class="col-xl-6 offset-md-3">
                        <div class="col-md-12">
                            <h3> Info Penggalangan</h3>
                            <div class="form-group">
                                <label class="control-label text-black-100">Kategori apa yang paling tepat untuk penggalangan dana ini? <font class="red">*</font></label>
                                <select  class="form-control" name="kategori" v-model="kategori">
                                    <option value="" disabled>Pilih Kategori</option>
                                    <option v-for="(item, idx) in category" :key="idx" v-bind:value="item.id_category">
                                        {{ item.category_description }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-black-100">Apa judul untuk penggalangan dana ini? <font class="red">*</font></label>
                                <input maxlength="50" type="text" class="judul form-control" name="judul" v-model="judul" placeholder="Contoh: Bantu Robin Melawan Kanker" />
                                <span class="judul label label-danger displaynone">Judul wajib diisi</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-black-100">Target donasi <font class="red">*</font></label>
                                <input type="text" class="target form-control" name="target" v-model="target" placeholder="0" />
                                <span class="target label label-danger displaynone">Target donasi wajib diisi</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-black-100">Batas tanggal terakhir penggalangan dana <font class="red">*</font></label>
                                <date-picker input-class="batastanggal form-control" type="datetime" format="YYYY-MM-DD hh:mm:ss" lang="en" width="100%" v-model="batastanggal" confirm></date-picker>
                                <span class="batastanggal label label-danger displaynone">Batas tanggal wajib diisi</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-black-100">Tentukan link untuk Penggalangan <font class="red">*</font></label>
                                <input type="text" class="link form-control" name="link" v-model="link" placeholder="Contoh: banturobin"  />
                                <span class="link label label-danger displaynone">Link penggalangan wajib diisi</span>
                            </div>
                            <button class="btn btn-primary nextBtn btn-lg" type="button">Next</button>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xl-6 offset-md-3">
                        <div class="col-md-12">
                            <h3> Cerita Penggalangan</h3>
                            <div v-if="checkedfoto=='0'" class="image-added">
                                <img class="img-fluid" :src="tempfoto" v-model="foto">
                                <div class="button-change-image">
                                    <a href="#" v-on:click="wannachangeimage('1')" class="btn btn-info">Ubah Gambar</a>
                                </div>
                            </div>
                            <div v-if="checkedfoto=='1'" class="form-group">
                                <label class="control-label text-black-100">Upload foto untuk penggalangan Anda <font class="red">*</font> <small>(Maksimum 2 MB)</small></label>
                                <input type="file" required="required" class="foto form-control" name="foto" v-on:change="onImageChange"/>
                                <span class="foto label label-danger displaynone">Foto wajib diupload</span>
                                <span class="foto2 label label-danger displaynone">Ukuran foto tidak boleh melebihi 2 MB</span>
                                <div class="button-change-image mt-1">
                                    <a href="#" v-on:click="wannachangeimage('0')" class="btn btn-info">Batal Ubah Gambar</a>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label text-black-100">Ceritakan tentang diri Anda, alasan penggalangan dana, dan rencana penggunaan dana <font class="red">*</font></label>
                                <vue-editor id="editor" useCustomImageHandler @imageAdded="handleImageAdded" v-model="isicampaign" placeholder="Buat cerita yang menyentuh dan menarik"> </vue-editor>
                                <span style="padding:0px;font-size:14px" class="ql-editor label label-danger displaynone">Isi campaign wajib diisi</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-black-100">Tulis ajakan singkat untuk mengajak orang berdonasi <font class="red">*</font></label>
                                <input type="textarea" class="ajakansingkat form-control" name="ajakansingkat" v-model="ajakansingkat" placeholder="Contoh: Mohon Bantu Robin Melawan Kanker Tulang"  />
                                <span class="ajakansingkat label label-danger displaynone">Ajakan singkat wajib diisi</span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="setup-panel">
                                        <a href="#step-1" class="btn btn-primary btn-lg">Sebelumnya</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xl-6 offset-md-3">
                        <div class="col-md-12">
                            <h3> Konfirmasi</h3>
                            <div class="form-group">
                                <label class="control-label text-black-100">Nomor HP anda <font class="red">*</font></label>
                                <input type="number" required="required" class="nomorhp form-control" name="nomorhp" v-model="nomorhp" placeholder="contoh: 081234567890" />
                                <span class="nomorhp label label-danger displaynone">Nomor handphone wajib diisi</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label text-black-100">Galang dana ini ditujukan untuk keperluan? <font class="red">*</font></label>
                                <select class="form-control" name="keperluan" v-model="keperluan">
                                    <option value="Saya sendiri">Saya sendiri</option>
                                    <option value="Keluarga/Kerabat">Keluarga/Kerabat</option>
                                    <option value="Organisasi/Lembaga">Organisasi/Lembaga</option>
                                </select>
                            </div>
        
                            <div class="row">
                                <div class="col-6">
                                    <div class="setup-panel">
                                        <a href="#step-2" class="btn btn-primary btn-lg">Sebelumnya</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit" >Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker'
import { VueEditor } from "vue2-editor";
import GlobalMethod from './../mixins/globalmethod'

export default {
    mixins: [ GlobalMethod ],
    components:{
        'DatePicker': DatePicker,
        'VueEditor': VueEditor
    },
    data(){
        return{
            path: this.$route.params.id,
            checked : false,
            kategori: '',
            judul: '',
            target: '',
            batastanggal: '',
            link: '',
            foto: '',
            tempfoto: '',
            checkedfoto: '0',
            statusfoto: 0,
            isicampaign: '',
            ajakansingkat: '',
            nomorhp: '',
            keperluan: '',
            category: [],
            datacampaigns: [],
            errors: []
        }
    },
    methods: {
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.foto = e.target.files[0];
            vm.statusfoto = 1;
        },
        handleImageAdded: function(file, Editor, cursorLocation, resetUploader) 
        {
            // An example of using FormData
            // NOTE: Your key could be different such as:
            // formData.append('file', file)
            var formData = new FormData();
            formData.append("image", file);
        
            axios({
                url: "/api/admin/campaigns/imagesdescriptionupload",
                method: "POST",
                data: formData,
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            })
            .then(result => {
                let url = result.data.data.url; // Get url from response
                Editor.insertEmbed(cursorLocation, "image", url);
                resetUploader();
            })
            .catch(err => {
                this.handlerException(err)
            });
        },
        postcampaign(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('kategori',this.kategori);
            bodyParameters.append('judul', this.judul);
            bodyParameters.append('target', this.target);
            bodyParameters.append('batastanggal', this.batastanggal);
            bodyParameters.append('link', this.link);
            bodyParameters.append('foto', this.foto);
            bodyParameters.append('statusfoto', this.statusfoto);
            bodyParameters.append('isicampaign', this.isicampaign);
            bodyParameters.append('ajakansingkat', this.ajakansingkat);
            bodyParameters.append('nomorhp', this.nomorhp);
            bodyParameters.append('keperluan', this.keperluan);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/campaigns/'+ this.path + '/update',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        wannachangeimage(val) {
            if(val == '0'){
                this.statusfoto = '0';
                
            }
            this.checkedfoto = val;
        }
    },
    mounted() {
        var app = this;
        var config = {
            headers: {
                'Authorization': "Bearer " + localStorage.usertoken,
                'Content-Type': "multipart/form-data"
            }
        };
        axios.get('/api/campaigns/data/' + app.path, config)
        .then(function (res) {
            console.log(res.data.data);
            app.datacampaigns = res.data.data[0];
            app.kategori = app.datacampaigns.category.id_category;
            app.judul = app.datacampaigns.campaigns_title;
            app.target = app.datacampaigns.target_funds;
            app.batastanggal = app.datacampaigns.raising_deadline;
            app.link = app.datacampaigns.raising_link;
            app.foto = app.datacampaigns.campaigns_foto;
            app.tempfoto = app.foto;
            app.isicampaign = app.datacampaigns.campaigns_description;
            app.ajakansingkat = app.datacampaigns.short_invitation;
            app.nomorhp = app.datacampaigns.fundraiser_phone_number;
            app.keperluan = app.datacampaigns.purpose_of_raising;
            console.log(kategori);
        })
        .catch(function (res) {
            console.log(res);
        });

        axios.get('/api/category')
        .then(function (res) {
            app.category = res.data.data
            console.log(res.data);
            
        })
        .catch(function (res) {
            console.log(res);
        });

    },
}
</script>
