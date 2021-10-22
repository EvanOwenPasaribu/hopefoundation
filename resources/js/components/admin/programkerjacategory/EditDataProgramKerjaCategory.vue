<template>
    <div class="wrapper-nav-side">
        <h3><b>Edit Data Program Kerja Kategori</b></h3>
        <form class="form-group" v-on:submit.prevent="editdataprogramkerjacategory">
            <div class="form-group row">
                <label for="program_kerja_category_description" class="col-sm-2 col-form-label text-black-100">Nama Kategori</label>
                <div class="col-sm-10">
                     <textarea class="form-control" name="program_kerja_category_description" v-model="program_kerja_category_description" placeholder="Contoh: Kerja Bakti Sosial" id="program_kerja_category_description"></textarea>
                    <span v-if="errors.program_kerja_category_description" :class="['label label-danger']">{{ errors.program_kerja_category_description[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="program_kerja_url" class="col-sm-2 col-form-label text-black-100">Url Program Kerja</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="event_title" v-model="program_kerja_url" placeholder="Contoh: kerjabaktisosial (Jangan Menggunakan Spasi)" id="program_kerja_url">
                    <span v-if="errors.program_kerja_url" :class="['label label-danger']">{{ errors.program_kerja_url[0] }}</span>
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
import GlobalMethod from './../mixins/globalmethod';

export default {
    mixins: [ GlobalMethod ],
    components:{
        'VueEditor': VueEditor
    },
    data(){
        return{
            path: this.$route.params.id_programkerjacategory,
            program_kerja_category_description: '',
            program_kerja_url: '',
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
            axios.get('/api/admin/programkerjacategorys/' + app.path + '/edit',config).then((res) => 
            {
                this.program_kerja_category_description = res.data.data.program_kerja_category_description
                this.program_kerja_url = res.data.data.program_kerja_url
            })
            .catch((res) => {
                this.handlerException(res)
            })
        },
        editdataprogramkerjacategory(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('program_kerja_category_description',this.program_kerja_category_description);
            bodyParameters.append('program_kerja_url', this.program_kerja_url);
            bodyParameters.append('_method', 'PATCH')
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/programkerjacategorys/' + this.path + '/edit',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.program_kerja_category_description = res.data.data.program_kerja_category_description;
                this.program_kerja_url = res.data.data.program_kerja_url;
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>