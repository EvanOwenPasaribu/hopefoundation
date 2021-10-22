<template>
    <div class="wrapper-nav-side">
        <h3><b>Edit Data Program Kerja</b></h3>
        <form class="form-group" v-on:submit.prevent="editdataprogramkerja">
            <div class="form-group row">
                <label for="program_kerja_title" class="col-sm-2 col-form-label text-black-100">Judul Program Kerja</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="program_kerja_title" v-model="program_kerja_title" placeholder="Contoh: Program bazaar amal untuk bencana di Tapanuli Utara" id="program_kerja_title">
                    <span v-if="errors.program_kerja_title" :class="['label label-danger']">{{ errors.program_kerja_title[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="program_kerja_category" class="col-sm-2 col-form-label text-black-100">Kategori Program Kerja</label>
                <div class="col-sm-10">
                    <select class="form-control" name="program_kerja_category" v-model="program_kerja_category">
                        <option value="" disabled>Pilih Kategori Program Kerja</option>
                        <option v-for="(item, idx) in programkerjacategory" :key="idx" :value="item.id_programkerjacategory" :selected="item.id_programkerjacategory == program_kerja_category">
                            {{ item.program_kerja_category_description }}
                        </option>
                    </select>
                    <span v-if="errors.program_kerja_category" :class="['label label-danger']">{{ errors.program_kerja_category[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="program_kerja_short_description" class="col-sm-2 col-form-label text-black-100">Deskripsi Singkat</label>
                <div class="col-sm-10">
                     <textarea class="form-control" name="program_kerja_short_description" v-model="program_kerja_short_description" placeholder="Contoh: Program bazaar amal dilaksanakan dan tujuannya untuk apa...." id="program_kerja_short_description"></textarea>
                    <span v-if="errors.program_kerja_short_description" :class="['label label-danger']">{{ errors.program_kerja_short_description[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="editor" class="col-sm-2 col-form-label text-black-100">Deskripsi Lengkap Program Kerja</label>
                <div class="col-sm-10">
                    <vue-editor id="editor" class="text-black-100 backgroundwhite" useCustomImageHandler @imageAdded="handleImageAdded" v-model="program_kerja_description" placeholder="Contoh: Program bazaar amal dilakukan pada saat kapan dan dimana (Bagian isi kegiatan harus lengkap)"></vue-editor>
                </div>
                <div class="row" style="width:100%;margin:0px;">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <span v-if="errors.program_kerja_description" :class="['label label-danger']">{{ errors.program_kerja_description[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="program_kerja_foto" class="col-sm-2 col-form-label text-black-100">Foto Utama Program Kerja</label>
                <div class="col-sm-10">
                    <img :src="program_kerja_foto" style="width:200px"/>
                    <input type="file" class="foto form-control" name="program_kerja_foto" v-on:change="onImageChange" id="program_kerja_foto" ref="fileInput"/>
                    <span v-if="errors.program_kerja_foto" :class="['label label-danger']">{{ errors.program_kerja_foto[0] }}</span>
                </div>
            </div>
            <div class="row project-button-without-padding float-right">
                <button type="submit" class="btn btn-primary py-3 px-4" style="width:max-content">KIRIM</button>
            </div>
        </form>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor"
import GlobalMethod from './../mixins/globalmethod'

export default {
    mixins: [ GlobalMethod ],
    components:{
        'VueEditor': VueEditor
    },
    data(){
        return{
            path: this.$route.params.id_programkerja,
            program_kerja_title: '',
            program_kerja_category: '',
            program_kerja_short_description: '',
            program_kerja_description: '',
            program_kerja_foto: '',
            foto: '',
            programkerjacategory: [],
            errors: []
        }
    },

    mounted() {
        this.getProgramKerjaCategory()
        this.showData()
    },
    methods: {
        showData(){
            var app = this;
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            axios.get('/api/admin/programkerjas/' + app.path + '/edit',config).then((res) => 
            {
                app.program_kerja_title = res.data.data.program_kerja_title
                app.program_kerja_category = res.data.data.id_programkerjacategory
                app.program_kerja_short_description = res.data.data.program_kerja_short_description
                app.program_kerja_description = res.data.data.program_kerja_description
                app.program_kerja_foto = res.data.data.program_kerja_foto
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        getProgramKerjaCategory(){
            var app = this;
            axios.get('/api/programkerjacategory').then(function (res) {
                app.programkerjacategory = res.data.data
            })
            .catch(function (res) {
                this.handlerException(res)
            });
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
                this.program_kerja_foto = e.target.result;
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
                url: "/api/admin/programkerjas/imagesdescriptionupload",
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
        editdataprogramkerja(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('program_kerja_title',this.program_kerja_title);
            bodyParameters.append('program_kerja_category',this.program_kerja_category);
            bodyParameters.append('program_kerja_short_description', this.program_kerja_short_description);
            bodyParameters.append('program_kerja_description', this.program_kerja_description);
            bodyParameters.append('program_kerja_foto', this.foto);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/programkerjas/' + this.path + '/edit',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.program_kerja_title = res.data.data.program_kerja_title
                this.program_kerja_category = res.data.data.id_programkerjacategory
                this.program_kerja_short_description = res.data.data.program_kerja_short_description
                this.program_kerja_description = res.data.data.program_kerja_description
                this.foto = "";
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>