<template>
    <div class="wrapper-nav-side">
        <h3><b>Tambah Data Rumah Sakit/Klinik</b></h3>
        <form class="form-group" v-on:submit.prevent="tambahdatarumahsakit">
            <div class="form-group row">
                <label for="namarumahsakit" class="col-sm-2 col-form-label text-black-100">Nama Rumah Sakit/Klinik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="namarumahsakit" v-model="namarumahsakit" placeholder="Rumah Sakit Murni Teguh" id="namarumahsakit">
                    <span v-if="errors.namarumahsakit" :class="['label label-danger']">{{ errors.namarumahsakit[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamatrumahsakit" class="col-sm-2 col-form-label text-black-100">Alamat Rumah Sakit/Klinik</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamatrumahsakit" v-model="alamatrumahsakit" placeholder="Contoh: Jln. Palang Muda" id="alamatrumahsakit"></textarea>
                    <span v-if="errors.alamatrumahsakit" :class="['label label-danger']">{{ errors.alamatrumahsakit[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamatrumahsakit" class="col-sm-2 col-form-label text-black-100">Posisi Rumah Sakit/Klinik</label>
                <div class="col-sm-10">
                    <label for="map"><small>Cari Lokasi (Lakukan Pengisian Koordinat Lokasi Rumah Sakit/Klinik Dengan Mengklik Peta)</small></label>
                    <br>
                    <gmap-autocomplete
                        style="width:70%;"
                        @place_changed="setPlace"
                        :value="autocomplete" 
                        @input="value = $event.target.value">
                        </gmap-autocomplete>
                    <button type="button" @click="addMarker">Add</button>
                    <br>
                    <gmap-map
                        :center="center"
                        :zoom="15"
                        style="width:100%;  height: 400px;">
                        <gmap-marker
                            :key="index"
                            v-for="(m, index) in markers"
                            :position="m.position"
                            :clickable="true"
                            :draggable="true"
                            @drag="updateCoordinates"
                            @click="center=m.position">
                        </gmap-marker>
                    </gmap-map>
                    <span v-if="errors.latituders" :class="['label label-danger']">{{ errors.latituders[0] }}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="rumah_sakit_foto" class="col-sm-2 col-form-label text-black-100">Foto Rumah Sakit</label>
                <div class="col-sm-10">
                    <input type="file" class="foto form-control" name="rumah_sakit_foto" v-on:change="onImageChange" id="rumah_sakit_foto" ref="myFileInput"/>
                    <span v-if="errors.rumah_sakit_foto" :class="['label label-danger']">{{ errors.rumah_sakit_foto[0] }}</span>
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
            namarumahsakit: '',
            alamatrumahsakit: '',
            latituders: '',
            longituders: '',
            foto: '',
            errors: [],
            center: { lat: 3.597031, lng: 98.678513 },
            markers: [],
            places: [],
            currentPlace: null,
            autocomplete: ''
            
        }
    },

    mounted() {
        this.geolocate();
    },
    methods: {
        // receives a place object via the autocomplete component
        setPlace(place) {
            this.currentPlace = place;
        },
        addMarker() {
            if (this.currentPlace) {
                this.markers = [];
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng()
                };
                this.markers.push({ position: marker });
                this.places.push(this.currentPlace);
                this.center = marker;
                this.currentPlace = null;
                this.latituders = marker.lat;
                this.longituders = marker.lng;
            }
        },
        updateCoordinates(location) {
            this.latituders = location.latLng.lat();
            this.longituders = location.latLng.lng();
        },
        geolocate: function() {
            navigator.geolocation.getCurrentPosition(position => {
                this.center = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
            });
        },
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            let vm = this;
            vm.foto = e.target.files[0];
        },
        tambahdatarumahsakit(){
            this.errors = [];
            let bodyParameters = new FormData();
            var config = {
                headers: {
                    'Authorization': "Bearer " + localStorage.usertoken,
                    'Content-Type': "multipart/form-data"
                }
            };
            bodyParameters.append('namarumahsakit',this.namarumahsakit);
            bodyParameters.append('alamatrumahsakit', this.alamatrumahsakit);
            bodyParameters.append('latituders', this.latituders);
            bodyParameters.append('longituders', this.longituders);
            bodyParameters.append('rumah_sakit_foto', this.foto);
            this.$swal({
                title: "Harap Menunggu",
                text: "Sedang Memproses Permintaan",
                imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
                imageHeight: 100,
                showConfirmButton: false,
                allowOutsideClick: false
            });
            axios.post('/api/admin/rumahsakits/add',bodyParameters,config).then((res) => 
            {
                this.$swal({
                    title: 'Berhasil!',
                    text: res.data.message,
                    type: 'success'
                });
                this.namarumahsakit = "";
                this.alamatrumahsakit = "";
                this.latituders = "";
                this.longituders = "";
                this.foto = "";
                this.markers = [];
                this.places = [];
                this.currentPlace = null;
                this.center= { lat: 3.597031, lng: 98.678513 };
                this.geolocate();
                this.addressInput = "";
                this.$refs.myFileInput.value = '';
                this.autocomplete = '';
            })
            .catch((res) => {
                this.handlerException(res)
            })
        }
    }
}
</script>