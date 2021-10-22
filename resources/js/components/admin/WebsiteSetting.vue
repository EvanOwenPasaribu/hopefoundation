<template>
    <div class="wrapper-nav-side">
        <h3><b>Pengaturan Website</b></h3>
        <form class="form-group" v-on:submit.prevent="pengaturanwebsite">
            <div class="form-group row">
                <label for="namaaplikasi" class="col-sm-2 col-form-label text-black-100">Nama Aplikasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="app_name" v-model="app_name" placeholder="Contoh: Yayasan Hope" id="namaaplikasi">
                    <span v-if="errors.app_name" :class="['label label-danger']">{{ errors.app_name[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="fotocoverdepan" class="col-sm-2 col-form-label text-black-100">Foto Cover Depan</label>
                <div class="col-sm-10">
                    <img :src="front_picture" style="width:200px"/>
                    <input type="file" class="foto form-control" name="front_picture" v-on:change="onImageChange" id="fotocoverdepan" ref="fileInput"/>
                    <span v-if="errors.front_picture" :class="['label label-danger']">{{ errors.front_picture[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="editor" class="col-sm-2 col-form-label text-black-100">Profile Website</label>
                <div class="col-sm-10">
                    <vue-editor id="editor" class="text-black-100 backgroundwhite" useCustomImageHandler @imageAdded="handleImageAdded" v-model="profile_description" placeholder="Profile Website"></vue-editor>
                </div>
                <div class="row" style="width:100%;margin:0px;">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <span v-if="errors.profile_description" :class="['label label-danger']">{{ errors.profile_description[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="caption_front_picture" class="col-sm-2 col-form-label text-black-100">Caption Foto Depan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="caption_front_picture" v-model="caption_front_picture" placeholder="Contoh: Galang Dana Membantu Sesama" id="caption_front_picture">
                    <span v-if="errors.caption_front_picture" :class="['label label-danger']">{{ errors.caption_front_picture[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="caption_description_front_picture" class="col-sm-2 col-form-label text-black-100">Deskripsi Caption Foto Depan</label>
                <div class="col-sm-10">
                     <textarea class="form-control" name="caption_description_front_picture" v-model="caption_description_front_picture" placeholder="Contoh: Bahagia itu membuat orang lain bahagia dan dimulai dari berbagi" id="caption_description_front_picture"></textarea>
                    <span v-if="errors.caption_description_front_picture" :class="['label label-danger']">{{ errors.caption_description_front_picture[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="button_description_front_picture" class="col-sm-2 col-form-label text-black-100">Nama Button Pada Foto Depan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="button_description_front_picture" v-model="button_description_front_picture" placeholder="Contoh: Galang Dana" id="caption_front_picture">
                    <span v-if="errors.button_description_front_picture" :class="['label label-danger']">{{ errors.button_description_front_picture[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="whatsapp" class="col-sm-2 col-form-label text-black-100">Whatsapp</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="whatsapp" v-model="whatsapp" placeholder="Contoh: 0812345678900" id="whatsapp">
                    <span v-if="errors.whatsapp" :class="['label label-danger']">{{ errors.whatsapp[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="about_us_description_footer" class="col-sm-2 col-form-label text-black-100">Informasi About Us Pada Footer</label>
                <div class="col-sm-10">
                     <textarea class="form-control" name="about_us_description_footer" v-model="about_us_description_footer" placeholder="Contoh: Yayasan Hope merupakan...."></textarea>
                    <span v-if="errors.about_us_description_footer" :class="['label label-danger']">{{ errors.about_us_description_footer[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="address_footer" class="col-sm-2 col-form-label text-black-100">Alamat Pada Footer</label>
                <div class="col-sm-10">
                     <textarea class="form-control" name="address_footer" v-model="address_footer" placeholder="Contoh: Jln. Selam IV No. 101"></textarea>
                    <span v-if="errors.address_footer" :class="['label label-danger']">{{ errors.address_footer[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="number_phone_footer" class="col-sm-2 col-form-label text-black-100">Nomor Telepon Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="number_phone_footer" v-model="number_phone_footer" placeholder="Contoh: +62821-7077-0511" id="number_phone_footer">
                    <span v-if="errors.number_phone_footer" :class="['label label-danger']">{{ errors.number_phone_footer[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email_footer" class="col-sm-2 col-form-label text-black-100">Email Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email_footer" v-model="email_footer" placeholder="Contoh: yayasanhope@gmail.com" id="email_footer">
                    <span v-if="errors.email_footer" :class="['label label-danger']">{{ errors.email_footer[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="youtube" class="col-sm-2 col-form-label text-black-100">Youtube Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="youtube" v-model="youtube" placeholder="Contoh: yayasan_hope" id="youtube">
                    <span v-if="errors.youtube" :class="['label label-danger']">{{ errors.youtube[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="facebook" class="col-sm-2 col-form-label text-black-100">Facebook Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="facebook" v-model="facebook" placeholder="Contoh: yayasan_hope" id="facebook">
                    <span v-if="errors.facebook" :class="['label label-danger']">{{ errors.facebook[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="instagram" class="col-sm-2 col-form-label text-black-100">Instagram Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="instagram" v-model="instagram" placeholder="Contoh: yayasan_hope" id="instagram">
                    <span v-if="errors.instagram" :class="['label label-danger']">{{ errors.instagram[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="facebookpage" class="col-sm-2 col-form-label text-black-100">Facebook Page Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="facebook_page" v-model="facebook_page" placeholder="Contoh: yayasan_hope" id="facebook_page">
                    <span v-if="errors.facebook_page" :class="['label label-danger']">{{ errors.facebook_page[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="pilihan_kota" class="col-sm-2 col-form-label text-black-100">Pilihan Kota</label>
                <div class="col-sm-10">
                    <select class="form-control" name="pilihan_kota" v-model="pilihan_kota" id="pilihan_kota">
                        <option value="" disabled selected>Pilih Kota Tempat Vaksin</option>
                        <option v-for="(item, idx) in kotas" :key="idx" :value="item.id_kota" :disabled="item.is_active == 'N'">
                        {{ item.namakota }} ({{ item.tanggalvaksin | moment("timezone", "Asia/Bangkok", "dddd, DD MMMM YYYY") }}-{{ item.tanggalvaksinselesai | moment("timezone", "Asia/Bangkok", "dddd, DD MMMM YYYY") }})
                        </option>
                    </select>
                    <span v-if="errors.pilihan_kota" :class="['label label-danger']">{{ errors.pilihan_kota[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="excel" class="col-sm-2 col-form-label text-black-100">Import File Excel Vaksinasi</label>
                <div class="col-sm-10">
                    <input type="file" class="foto2 form-control" name="excel" v-on:change="onImageChange2" id="excel" ref="fileInput2"/>
                    <span v-if="errors.excel" :class="['label label-danger']">{{ errors.excel[0] }}</span>
                </div>
            </div>
             <div class="form-group row">
                <label for="excelkodependaftaran" class="col-sm-2 col-form-label text-black-100">Import Excel Kode Pendaftaran</label>
                <div class="col-sm-10">
                    <input type="file" class="foto3 form-control" name="excelkodependaftaran" v-on:change="onImageChange3" id="excelkodependaftaran" ref="fileInput3"/>
                    <span v-if="errors.excelkodependaftaran" :class="['label label-danger']">{{ errors.excelkodependaftaran[0] }}</span>
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
import GlobalMethod from './mixins/globalmethod'

export default {
    mixins: [ GlobalMethod ],
    components:{
        'VueEditor': VueEditor
    },
    data(){
        return{
            kotas: [],
            app_name: '',
            front_picture: '',
            profile_description: '',
            caption_front_picture: '',
            caption_description_front_picture: '',
            button_description_front_picture: '',
            about_us_description_footer: '',
            address_footer: '',
            number_phone_footer: '',
            email_footer: '',
            whatsapp: '',
            youtube: '',
            facebook: '',
            instagram: '',
            facebook_page: '',
            foto: '',
            foto2: '',
            foto3: '',
            excel: '',
            excelkodependaftaran: '',
            pilihan_kota: '',
            errors: []
        }
    },

    mounted() {
        this.showTemplates()
        this.getKota()
    },
    methods: {
        getKota(){
            var app = this;
            axios.get('/api/kotas').then(function (res) {
                app.kotas = res.data.data
            })
            .catch(function (res) {
                console.log(res);
            });
        },
        showTemplates(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/templates',config).then((res) => 
            {
                app.app_name = res.data.data.app_name
                app.front_picture = res.data.data.front_picture
                app.profile_description = res.data.data.profile_description
                app.caption_front_picture =  res.data.data.caption_front_picture
                app.caption_description_front_picture =  res.data.data.caption_description_front_picture
                app.button_description_front_picture = res.data.data.button_description_front_picture
                app.about_us_description_footer = res.data.data.about_us_description_footer
                app.address_footer = res.data.data.address_footer
                app.number_phone_footer =  res.data.data.number_phone_footer
                app.email_footer = res.data.data.email_footer
                app.whatsapp = res.data.data.whatsapp
                app.youtube = res.data.data.youtube,
                app.facebook = res.data.data.facebook
                app.instagram = res.data.data.instagram
                app.facebook_page = res.data.data.facebook_page

            })
            .catch((res) => {
                console.log(res);
            })
        },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.foto = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(vm.foto);
            reader.onload = e =>{
                this.front_picture = e.target.result;
            };
            
        },
        onImageChange2(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.foto2 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(vm.foto2);
            reader.onload = e =>{
                this.excel = e.target.result;
            };
            
        },
        onImageChange3(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.foto3 = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(vm.foto3);
            reader.onload = e =>{
                this.excelkodependaftaran = e.target.result;
            };
            
        },
        handleImageAdded: function(file, Editor, cursorLocation, resetUploader) 
        {
            // An example of using FormData
            // NOTE: Your key could be different such as:
            // formData.append('file', file)
            var formData = new FormData();
            formData.append("image", file);
        
            axios({
                url: "/api/admin/templates/imagesdescriptionupload",
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
                this.handlerException(res)
            });
        },
        pengaturanwebsite(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('app_name',this.app_name);
            bodyParameters.append('front_picture', this.foto);
            bodyParameters.append('profile_description', this.profile_description);
            bodyParameters.append('caption_front_picture', this.caption_front_picture);
            bodyParameters.append('caption_description_front_picture', this.caption_description_front_picture);
            bodyParameters.append('button_description_front_picture', this.button_description_front_picture);
            bodyParameters.append('about_us_description_footer', this.about_us_description_footer);
            bodyParameters.append('address_footer', this.address_footer);
            bodyParameters.append('number_phone_footer', this.number_phone_footer);
            bodyParameters.append('email_footer', this.email_footer);
            bodyParameters.append('whatsapp', this.whatsapp);
            bodyParameters.append('youtube', this.youtube);
            bodyParameters.append('facebook', this.facebook);
            bodyParameters.append('instagram', this.instagram);
            bodyParameters.append('facebook_page', this.facebook_page);
            bodyParameters.append('pilihan_kota',this.pilihan_kota);
            bodyParameters.append('excel', this.foto2);
            bodyParameters.append('excelkodependaftaran', this.foto3);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/templates',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.app_name = res.data.data.app_name
                this.front_picture = res.data.data.front_picture
                this.profile_description = res.data.data.profile_description
                this.caption_front_picture =  res.data.data.caption_front_picture
                this.caption_description_front_picture =  res.data.data.caption_description_front_picture
                this.button_description_front_picture = res.data.data.button_description_front_picture
                this.about_us_description_footer = res.data.data.about_us_description_footer
                this.address_footer = res.data.data.address_footer
                this.number_phone_footer =  res.data.data.number_phone_footer
                this.email_footer = res.data.data.number_phone_footer
                this.whatsapp = res.data.data.whatsapp,
                this.youtube = res.data.data.youtube,
                this.facebook = res.data.data.facebook
                this.instagram = res.data.data.instagram
                this.facebook_page = res.data.data.facebook_page
                this.foto = "";
                this.foto2 = "";
                this.foto3 = "";
                const input = this.$refs.fileInput
                input.type = 'text'
                input.type = 'file'
                this.pilihan_kota = "";
                this.$refs.fileInput2.value = '';
                this.$refs.fileInput3.value = '';
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>