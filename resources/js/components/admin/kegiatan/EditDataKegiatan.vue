<template>
    <div class="wrapper-nav-side">
        <h3><b>Tambah Data Kegiatan</b></h3>
        <form class="form-group" v-on:submit.prevent="editdatakegiatan">
            <div class="form-group row">
                <label for="judulevent" class="col-sm-2 col-form-label text-black-100">Judul Kegiatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="event_title" v-model="event_title" placeholder="Contoh: Kegiatan Berdana Makanan di Panti Asuhan" id="judulevent">
                    <span v-if="errors.event_title" :class="['label label-danger']">{{ errors.event_title[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="deskripsisingkat" class="col-sm-2 col-form-label text-black-100">Deskripsi Singkat</label>
                <div class="col-sm-10">
                     <textarea class="form-control" name="event_short_description" v-model="event_short_description" placeholder="Contoh: Kegiatan Berdana dilakukan di Panti Asuhan Yayasan Kasih...." id="deskripsisingkat"></textarea>
                    <span v-if="errors.event_short_description" :class="['label label-danger']">{{ errors.event_short_description[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="editor" class="col-sm-2 col-form-label text-black-100">Isi Kegiatan</label>
                <div class="col-sm-10">
                    <vue-editor id="editor" class="text-black-100 backgroundwhite" useCustomImageHandler @imageAdded="handleImageAdded" v-model="event_description" placeholder="Contoh: Berdana merupakan moment yang sangat bermakna (Bagian isi kegiatan harus lengkap)"></vue-editor>
                </div>
                <div class="row" style="width:100%;margin:0px;">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <span v-if="errors.event_description" :class="['label label-danger']">{{ errors.event_description[0] }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="fotokegiatan" class="col-sm-2 col-form-label text-black-100">Foto Utama Kegiatan</label>
                <div class="col-sm-10">
                    <img :src="event_foto" style="width:200px"/>
                    <input type="file" class="foto form-control" name="event_foto" v-on:change="onImageChange" id="fotokegiatan" ref="fileInput"/>
                    <span v-if="errors.event_foto" :class="['label label-danger']">{{ errors.event_foto[0] }}</span>
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
            path: this.$route.params.id_event,
            event_title: '',
            event_short_description: '',
            event_description: '',
            event_foto: '',
            foto: '',
            errors: []
        }
    },

    mounted() {
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
            axios.get('/api/admin/events/' + app.path + '/edit',config).then((res) => 
            {
                app.event_title = res.data.data.event_title
                app.event_short_description = res.data.data.event_short_description
                app.event_description = res.data.data.event_description
                app.event_foto = res.data.data.event_foto
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
            const reader = new FileReader();
            reader.readAsDataURL(vm.foto);
            reader.onload = e =>{
                this.event_foto = e.target.result;
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
                url: "/api/admin/events/imagesdescriptionupload",
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
        editdatakegiatan(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('event_title',this.event_title);
            bodyParameters.append('event_short_description', this.event_short_description);
            bodyParameters.append('event_description', this.event_description);
            bodyParameters.append('event_foto', this.foto);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/events/' + this.path + '/edit',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.event_title = res.data.data.event_title
                this.event_short_description = res.data.data.event_short_description
                this.event_description = res.data.data.event_description
                this.foto = "";
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>