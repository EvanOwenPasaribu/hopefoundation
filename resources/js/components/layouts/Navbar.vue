<template>
    <div>
        <nav v-if="user.users_status =='1' || !auth" :class="[isActive == '/' ?'navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target':'navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light bg-dark site-navbar-target']" id="ftco-navbar">
            <div class="container">
                <router-link class="navbar-brand" to="/"><img :src="'/images/base/logohopebiasateksputih.png'" style="width:110px;margin-top:-10px;"/></router-link>
                <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span>
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav nav ml-auto">
                        <li class="nav-item"><a :href="$router.resolve({ name: 'campaign', query: { kategori: 0, keywords: ''}}).href" class="nav-link"><span>Donasi</span></a></li>
                        <li class="nav-item"><router-link class="nav-link" to="/profilewebsite"><span>Profile</span></router-link></li>
                        <li class="nav-item"><a :href="$router.resolve({ name: 'event' }).href" class="nav-link"><span>Kegiatan</span></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Program Kerja
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a :href="$router.resolve({ name: 'programkerja', params: { program_kerja_url: item.program_kerja_url }}).href" class="dropdown-item" v-for="(item, idx) in programkerjacategory" :key="idx">{{item.program_kerja_category_description}}</a>
                            </div>
                        </li>
                        <li class="nav-item"><a :href="$router.resolve({ name: 'fundraising' }).href" class="nav-link"><span>Fundraising</span></a></li>
                        <li class="nav-item"><router-link class="nav-link" to="/contactus"><span>Contact Us</span></router-link></li>
                        <li v-if="auth!='loggedin'" class="nav-item cta paddingnav"><router-link class="nav-link" to="/auth/register">Daftar</router-link></li>
                        <li v-if="auth!='loggedin'" class="nav-item cta"><router-link class="nav-link" to="/auth/login">Masuk</router-link></li>
                        <li v-if="auth=='loggedin'" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{user.name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <router-link active-class="active" class="handcursor dropdown-item" to="/isibalance"><span>Balance: Rp. {{ formatPrice(user.balance) }}</span></router-link>
                                <hr id="khusus">
                                <a active-class="active" class="handcursor dropdown-item">Dashboard</a>
                                <hr id="khusus">
                                <a class="handcursor dropdown-item" v-on:click="logout">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="nav-side-menu" v-if="user.users_status =='0'">
            <div class="brand">Administrator Area</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                    <router-link tag="li" :to="{name:'homeusers'}" active-class="active">
                        <a>
                            <i class="fa fa-archive fa-lg"></i> 
                            Dashboard
                        </a>
                    </router-link>
                    <li data-toggle="collapse" data-target="#master" :class="[{'active collapsed': subIsActive('/admin/dashboard/programkerjacategorys')}]">
                        <a>
                            <i class="fa fa-database fa-lg"></i>  
                            Data Master
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="master">
                        <router-link tag="li" :to="{name:'adminprogramkerjacategorys'}" active-class="active">
                            <a href="#">Program Kerja Kategori</a>
                        </router-link>
                    </ul>
                    <li data-toggle="collapse" data-target="#perencanaan" :class="[{'active collapsed': subIsActive('/admin/dashboard/events')}, {'active collapsed': subIsActive('/admin/dashboard/programkerjas')}, {'active collapsed': subIsActive('/admin/dashboard/informasikesehatans')}]">
                        <a>
                            <i class="fa fa-pencil-alt fa-lg"></i>  
                            Data Perencanaan
                            <span class="arrow"></span>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="perencanaan">
                        <router-link tag="li" :to="{name:'adminevents'}" active-class="active">
                            <a href="#">Kegiatan</a>
                        </router-link>
                        <router-link tag="li" :to="{name:'adminprogramkerjas'}" active-class="active">
                            <a href="#">Program Kerja</a>
                        </router-link>
                        <router-link tag="li" :to="{name:'admininformasikesehatans'}" active-class="active">
                            <a href="#">Informasi Kesehatan</a>
                        </router-link>
                        <router-link tag="li" :to="{name:'admindokters'}" active-class="active">
                            <a href="#">Dokter</a>
                        </router-link>
                        <router-link tag="li" :to="{name:'adminrsdankliniks'}" active-class="active">
                            <a href="#">RS & Klinik</a>
                        </router-link>
                        <router-link tag="li" :to="{name:'adminpendonors'}" active-class="active">
                            <a href="#">Pendonor</a>
                        </router-link>
                    </ul>
                    <router-link tag="li" :to="{name:'adminfundraisingproducts'}" active-class="active">
                        <a>
                            <i class="fa fa-cart-arrow-down fa-lg"></i>
                            Data Product
                        </a>
                    </router-link>
                    <router-link tag="li" :to="{name:'admingalangdana'}" active-class="active">
                        <a>
                            <i class="fa fa-wallet fa-lg"></i> 
                            Data Galang Dana
                        </a>
                    </router-link> 
                    <router-link tag="li" :to="{name:'admindonatur'}" active-class="active">
                        <a>
                            <i class="fa fa-address-book fa-lg"></i> 
                            Data Donatur
                        </a>
                    </router-link> 
                    <li data-toggle="collapse" data-target="#verifikasi" :class="[{'active collapsed': subIsActive('/admin/dashboard/verifikasitransferdana')}, {'active collapsed': subIsActive('/admin/dashboard/verifikasigalangdana')}, {'active collapsed': subIsActive('/admin/dashboard/verifikasisaldo')}]">
                        <a href="#">
                            <i class="fa fa-check fa-lg"></i> 
                            Verifikasi <span class="arrow"></span>
                        </a>
                    </li>
                    <ul class="sub-menu collapse" id="verifikasi">
                        <router-link tag="li" :to="{name:'adminverifikasigalangdana'}" active-class="active">
                            <a href="#">Verifikasi Galang Dana</a>
                        </router-link>
                        <router-link tag="li" :to="{name:'adminverifikasisaldo'}" active-class="active">
                            <a href="#">Verifikasi Isi Saldo</a>
                        </router-link>
                        <router-link tag="li" :to="{name:'adminverifikasitransferdana'}" active-class="active">
                            <a href="#">Verifikasi Transfer Dana</a>
                        </router-link>
                    </ul>
                    <li>
                         <router-link tag="li" :to="{name:'templatewebsite'}" active-class="active">
                            <a>
                                <i class="fa fa-wrench fa-lg"></i> 
                                Pengaturan Website
                            </a>
                         </router-link>
                    </li>
                    <li>
                        <a class="handcursor" v-on:click="logout">
                            <i class="fa fa-power-off fa-lg"></i> Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

export default {
  data () {
    return {
        isActive:this.$route.path,
        auth: localStorage.loggedin,
        programkerjacategory: []
    }
  },
  props: ['user'],
  methods: {
    subIsActive(input) {
        const paths = Array.isArray(input) ? input : [input];
        return paths.some(path => {
            return this.$route.path.indexOf(path) === 0
        })
    },
    formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    },
    logout () {
        let bodyParameters = new FormData();
        this.$swal({
            title: "Harap Menunggu",
            text: "Sedang Memproses Permintaan",
            imageUrl: location.protocol + '//' + location.host + '/images/base/loading_bar.gif',
            imageHeight: 100,
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var config = {
            headers: {
                'Authorization': "Bearer " + localStorage.usertoken
            }
        };
        axios.post('/api/logout',bodyParameters,config).then((res) => 
        {
            localStorage.removeItem('usertoken')
            localStorage.removeItem('loggedin')
            localStorage.removeItem('userstatus')
            window.location.href = '/'
            //this.$swal({
                //position: 'top-end',
                //type: 'success',
                //title: res.data.message,
                //showConfirmButton: false,
                //timer: 5000,
                //toast: true
            //});
        })
        .catch((err) => {
            console.log(err);
        })
    }
  },
  mounted () {
    var app = this;
    axios.get('/api/programkerjacategory').then(function (res) {
        app.programkerjacategory = res.data.data
    })
    .catch(function (res) {
        console.log(res);
    });
  }

}

</script>