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
                <label for="programkerja" class="col-sm-2 col-form-label text-black-100">Program Kerja</label>
                <div class="col-sm-10">
                    <div id="wrapprogramkerja">
                        <div v-for="(item,index) in listProgramKerja"> 
                            <div class="btn btn-primary mb-2" style="color:black;width:250px">
                                {{item}}
                            </div>
                            <i style="color:black;cursor:pointer" @click="hapusProgramKerja(index)" class="fas fa-trash-alt"></i>
                            <br>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" name="programkerja" placeholder="Contoh: Donor Darah" id="programkerja">
                        <div class="input-group-append">
                            <a @click="tambahProgramKerja()" style="width:75px" class="btn btn-primary input-group-button">Tambah</a>
                        </div>
                    </div>
                    <span v-if="errors.program_kerja" :class="['label label-danger']">{{ errors.program_kerja[0] }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="fotoslider1" class="col-sm-2 col-form-label text-black-100">Foto Slider Home 1</label>
                <div class="col-sm-10">
                    <div class="row ml-0">
                        <template v-for="(item, index) in dataSlider1">
                            <div @mouseover="showIcDelete($event)" @mouseleave="hideIcDelete($event)"  class="box-image" v-bind:style="{'background-image':'url(' + item + ')'}">
                                <div style="display:none;height:100%;width:100%;background:rgba(0,0,0,0.3);justify-content:center;align-items:center">
                                    <i style="color:white" @click="deleteDataSlider1(index)" class="fas fa-trash-alt"></i>
                                </div>
                            </div>
                        </template>
                        <div  class="box-image">
                            <i class="hope-icon-upload">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.387 5.807a.387.387 0 1 0-.774 0v5.806H5.806a.387.387 0 1 0 0 .774h5.807v5.807a.387.387 0 1 0 .774 0v-5.807h5.807a.387.387 0 1 0 0-.774h-5.807V5.807z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24c6.627 0 12-5.373 12-12S18.627 0 12 0 0 5.373 0 12s5.373 12 12 12zm0-.774c6.2 0 11.226-5.026 11.226-11.226C23.226 5.8 18.2.774 12 .774 5.8.774.774 5.8.774 12 .774 18.2 5.8 23.226 12 23.226z"></path></svg>
                            </i>
                            <input type="file" class="input_file" name="image-slider-add" v-on:change="onImageChangeSlider1" id="image-slider-add" ref="fileInputimageslider1"/>
                        </div>
                    </div>
                    <span v-if="errors.dataSlider1" :class="['label label-danger']">{{ errors.dataSlider1[0] }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="fotoslider2" class="col-sm-2 col-form-label text-black-100">Foto Slider Home 2</label>
                <div class="col-sm-10">
                    <div class="row ml-0">
                        <template v-for="(item, index) in dataSlider2">
                            <div @mouseover="showIcDelete($event)" @mouseleave="hideIcDelete($event)"  class="box-image" v-bind:style="{'background-image':'url(' + item + ')'}">
                                <div style="display:none;height:100%;width:100%;background:rgba(0,0,0,0.3);justify-content:center;align-items:center">
                                    <i style="color:white" @click="deleteDataSlider2(index)" class="fas fa-trash-alt"></i>
                                </div>
                            </div>
                        </template>
                        <div  class="box-image">
                            <i class="hope-icon-upload">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.387 5.807a.387.387 0 1 0-.774 0v5.806H5.806a.387.387 0 1 0 0 .774h5.807v5.807a.387.387 0 1 0 .774 0v-5.807h5.807a.387.387 0 1 0 0-.774h-5.807V5.807z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 24c6.627 0 12-5.373 12-12S18.627 0 12 0 0 5.373 0 12s5.373 12 12 12zm0-.774c6.2 0 11.226-5.026 11.226-11.226C23.226 5.8 18.2.774 12 .774 5.8.774.774 5.8.774 12 .774 18.2 5.8 23.226 12 23.226z"></path></svg>
                            </i>
                            <input type="file" class="input_file" name="image-slider-add" v-on:change="onImageChangeSlider2" id="image-slider-add" ref="fileInputimageslider2"/>
                        </div>
                    </div>
                    <span v-if="errors.dataSlider2" :class="['label label-danger']">{{ errors.dataSlider2[0] }}</span>
                </div>
            </div>

            <div class="form-group row">
                <label for="fotoinfokesehatan" class="col-sm-2 col-form-label text-black-100">Foto Info Kesehatan</label>
                <div class="col-sm-10">
                    <img :src="front_picture_info_kesehatan" style="width:200px"/>
                    <input type="file" class="foto form-control" name="front_picture_info_kesehatan" v-on:change="onImageChangeInfoKesehatan" id="fotoinfokesehatan" ref="fileInputinfokesehatan"/>
                    <span v-if="errors.front_picture_info_kesehatan" :class="['label label-danger']">{{ errors.front_picture_info_kesehatan[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="fotoedukasikesehatan" class="col-sm-2 col-form-label text-black-100">Foto Edukasi Kesehatan</label>
                <div class="col-sm-10">
                    <img :src="front_picture_edukasi_kesehatan" style="width:200px"/>
                    <input type="file" class="foto form-control" name="front_picture_edukasi_kesehatan" v-on:change="onImageChangeEdukasiKesehatan" id="fotoedukasikesehatan" ref="fileInputedukasikesehatan"/>
                    <span v-if="errors.front_picture_edukasi_kesehatan" :class="['label label-danger']">{{ errors.front_picture_edukasi_kesehatan[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="fotokerjasama" class="col-sm-2 col-form-label text-black-100">Foto Kerja Sama</label>
                <div class="col-sm-10">
                    <img :src="front_picture_kerja_sama" style="width:200px"/>
                    <input type="file" class="foto form-control" name="front_picture_kerja_sama" v-on:change="onImageChangeKerjaSama" id="fotokerjasama" ref="fileInputkerjasama"/>
                    <span v-if="errors.front_picture_kerja_sama" :class="['label label-danger']">{{ errors.front_picture_kerja_sama[0] }}</span>
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
                <label for="instagrampage" class="col-sm-2 col-form-label text-black-100">Instagram Page Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="instagram_page" v-model="instagram_page" placeholder="Contoh: yayasan_hope" id="instagram_page">
                    <span v-if="errors.instagram_page" :class="['label label-danger']">{{ errors.instagram_page[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="youtubepage" class="col-sm-2 col-form-label text-black-100">Youtube Page Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="youtube_page" v-model="youtube_page" placeholder="Contoh: yayasan_hope" id="youtube_page">
                    <span v-if="errors.youtube_page" :class="['label label-danger']">{{ errors.youtube_page[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="tiktokpage" class="col-sm-2 col-form-label text-black-100">Tiktok Page Pada Footer</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="tiktok_page" v-model="tiktok_page" placeholder="Contoh: yayasan_hope" id="tiktok_page">
                    <span v-if="errors.tiktok_page" :class="['label label-danger']">{{ errors.tiktok_page[0] }}</span>
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
            selectedImg1 : '',
            front_picture_info_kesehatan: '',
            front_picture_edukasi_kesehatan: '',
            front_picture_kerja_sama: '',
            fotoinfokesehatan : '',
            fotoedukasikesehatan : '',
            fotokerjasama : '',
            facebook_page: '',
            instagram_page: '',
            youtube_page: '',
            tiktok_page: '',
            foto: '',
            foto2: '',
            foto3: '',
            excel: '',
            excelkodependaftaran: '',
            pilihan_kota: '',
            errors: [],
            listProgramKerja : [],
            dataSlider1 : [],
            listFotoSlider1 : [],
            dataSlider2 : [],
            listFotoSlider2 : [],
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
                app.listProgramKerja = JSON.parse(res.data.data.program_kerja)
                app.dataSlider1 = JSON.parse(res.data.data.picture_slider1)
                app.dataSlider2 = JSON.parse(res.data.data.picture_slider2)
                app.front_picture_info_kesehatan = res.data.data.picture_info_kesehatan
                app.front_picture_edukasi_kesehatan = res.data.data.picture_edukasi_kesehatan
                app.front_picture_kerja_sama = res.data.data.picture_kerja_sama
                app.facebook_page = res.data.data.facebook_page
                app.instagram_page = res.data.data.instagram_page
                app.youtube_page = res.data.data.youtube_page
                app.tiktok_page = res.data.data.tiktok_page
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
        onImageChangeInfoKesehatan(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.fotoinfokesehatan = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(vm.fotoinfokesehatan);
            reader.onload = e =>{
                this.front_picture_info_kesehatan = e.target.result;
            };
        },
        onImageChangeEdukasiKesehatan(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.fotoedukasikesehatan = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(vm.fotoedukasikesehatan);
            reader.onload = e =>{
                this.front_picture_edukasi_kesehatan = e.target.result;
            };
        },
        onImageChangeKerjaSama(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.fotokerjasama = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(vm.fotokerjasama);
            reader.onload = e =>{
                this.front_picture_kerja_sama = e.target.result;
            };
        },
        onImageChangeSlider1(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            let img = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = e =>{
                let temp = e.target.result;
                this.dataSlider1.push(temp);
                this.listFotoSlider1.push(img);
            };
        },
        onImageChangeSlider2(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            let img = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = e =>{
                let temp = e.target.result;
                this.dataSlider2.push(temp);
                this.listFotoSlider2.push(img);
            };
        },
        showIcDelete(e){
             e.target.querySelector('div').style.display = "flex"
        },
        hideIcDelete(e){
            e.target.querySelector('div').style.display = "none"
        },
        deleteDataSlider1(index){
            let lengtholddata = this.dataSlider1.length - this.listFotoSlider1.length;
            this.dataSlider1.splice(index,1);
            if(index => lengtholddata){
                this.listFotoSlider1.splice(index-lengtholddata, 1);
            }
        },
        deleteDataSlider2(index){
            let lengtholddata = this.dataSlider2.length - this.listFotoSlider2.length;
            this.dataSlider2.splice(index,1);
            if(index => lengtholddata){
                this.listFotoSlider2.splice(index-lengtholddata, 1);
            }
        },
        tambahProgramKerja(){
            var s = $("#programkerja").val();
            if(s.trim() == ""){
                this.$swal({
                    title: 'Error',
                    text: "Tidak Boleh Kosong",
                    type: 'error'
                });
            }else{
                this.listProgramKerja.push(s);
                $("#programkerja").val("");
            }
        },
        hapusProgramKerja(index){
            this.listProgramKerja.splice(index, 1);
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
            bodyParameters.append('program_kerja', JSON.stringify(this.listProgramKerja));
            bodyParameters.append('countImageSlider1', this.listFotoSlider1.length);
            console.log(this.listFotoSlider1.length);
            for(let i=0;i<this.listFotoSlider1.length;i++){
                var indexUpdateArray = this.listFotoSlider1.length - (i+1);
                bodyParameters.append('slider_picture1'+(i+1), this.listFotoSlider1[i]);
            }
            bodyParameters.append('oldDataSlider1', JSON.stringify(this.dataSlider1.slice(0,this.dataSlider1.length-this.listFotoSlider1.length)));
            
            bodyParameters.append('countImageSlider2', this.listFotoSlider2.length);
            for(let i=0;i<this.listFotoSlider2.length;i++){
                var indexUpdateArray = this.listFotoSlider2.length - (i+1);
                bodyParameters.append('slider_picture2'+(i+1), this.listFotoSlider2[i]);
            }
            bodyParameters.append('oldDataSlider2', JSON.stringify(this.dataSlider2.slice(0,this.dataSlider2.length-this.listFotoSlider2.length)));
            
            bodyParameters.append('front_picture_info_kesehatan', this.fotoinfokesehatan);
            bodyParameters.append('front_picture_edukasi_kesehatan', this.fotoedukasikesehatan);
            bodyParameters.append('front_picture_kerja_sama', this.fotokerjasama);
            bodyParameters.append('facebook_page', this.facebook_page);
            bodyParameters.append('instagram_page', this.instagram_page);
            bodyParameters.append('youtube_page', this.youtube_page);
            bodyParameters.append('tiktok_page', this.tiktok_page);
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
                this.listProgramKerja = JSON.parse(res.data.data.program_kerja)
                this.listFotoSlider1 = []
                this.dataSlider1 = JSON.parse(res.data.data.picture_slider1)
                this.listFotoSlider2 = []
                this.dataSlider2 = JSON.parse(res.data.data.picture_slider2)
                this.front_info_kesehatan = res.data.picture_info_kesehatan
                this.front_edukasi_kesehatan = res.data.picture_edukasi_kesehatan
                this.front_kerja_sama = res.data.picture_kerja_sama
                this.facebook_page = res.data.data.facebook_page
                this.instagram_page = res.data.data.instagram_page
                this.youtube_page = res.data.data.youtube_page
                this.tiktok_page = res.data.data.tiktok_page
                this.foto = "";
                this.foto2 = "";
                this.foto3 = "";
                const input = this.$refs.fileInput
                input.type = 'text'
                input.type = 'file'
                this.pilihan_kota = "";
                this.$refs.fileInput2.value = '';
                this.$refs.fileInput3.value = '';
                this.$refs.fileInputimageslider1.value = '';
                this.$refs.fileInputimageslider2.value = '';
                this.$refs.fileInputinfokesehatan.value = '';
                this.$refs.fileInputedukasikesehatan.value = '';
                this.$refs.fileInputkerjasama.value = '';
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>