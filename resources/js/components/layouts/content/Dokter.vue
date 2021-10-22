<template>
    <div>
        <h2 class="text-center">{{dokter.namadokter}}</h2>
        <h5 class="text-center">Spesialist: {{dokter.spesialist}}</h5>
        <h5 class="text-center">Tempat Praktek: <router-link :to="{ name: 'detailrumahsakit', params: { id_rumahsakit: dokter.id_rumahsakit }}">{{dokter.rumahsakit.namarumahsakit}}</router-link></h5>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <a :href="dokter.dokter_foto" target="_blank"><img :src="dokter.dokter_foto" style="width:100%"/></a>
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <hr>
        <h4><b>Jadwal Praktek</b></h4>
        <div v-html="dokter.jadwalpraktek" class="paddingtop20px text-black-100">
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            
        },
        data(){
            return{
            }
        },
        props: ['dokter'],
        methods:{
            
        }
    }
</script>

