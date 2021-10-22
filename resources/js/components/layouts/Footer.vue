<template>
    <footer v-if="user.users_status =='1' || !auth" class="ftco-footer ftco-section" v-bind:style=" isActive == '/auth/login' || isActive == '/auth/register' || isActive == '/campaign/' + paramsJudulCampaign + '/donasisekarang' || isActive == '/auth/resendtoken' || isActive == '/auth/resetpassword' || isActive == '/auth/resetpassword/' + paramsTokenResetPassword ? 'display: none;' : '' ">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Tentang Kami</h2>
                        <p>{{templates.about_us_description_footer}}</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Quick Links</h2>
                        <ul class="list-unstyled">
                            <li><a :href="$router.resolve({ name: 'campaign', query: { kategori: 0, keywords: ''}}).href"><span class="icon-long-arrow-right mr-2"></span>Donasi</a></li>
                            <li><router-link to="/profilewebsite"><span class="icon-long-arrow-right mr-2"></span>Profile</router-link></li>
                            <li><router-link to="/contactus"><span class="icon-long-arrow-right mr-2"></span>Contact Us</router-link></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Facebook Page</h2>
                        <iframe :src="templates.facebook_page" width="300" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-0">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">{{templates.address_footer}}</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">{{templates.number_phone_footer}}</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">{{templates.email_footer}}</span></a></li>
                            </ul>
                        </div>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-4">
                            <li><a :href="'https://www.youtube.com/channel/' + templates.youtube" target="_blank"><span class="icon-youtube"></span></a></li>
                            <li><a :href="'https://www.facebook.com/groups/' + templates.facebook" target="_blank"><span class="icon-facebook"></span></a></li>
                            <li><a :href="'https://www.instagram.com/' + templates.instagram" target="_blank"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Copyright &copy;{{ new Date().getFullYear() }} All rights reserved | This website is made by <a :href="'https://wa.me/6282170770511'" target="_blank">En Andi</a></p>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>

export default {
  mounted () {
    
  },
  data () {
    return {
        isActive:this.$route.path,
        paramsJudulCampaign: this.$route.params.raising_link,
        paramsTokenResetPassword: this.$route.params.tokenresetpassword,
        auth: localStorage.loggedin
    }
  },
  props: ['user','templates'],
  method: {
    subIsActive(input) {
        const paths = Array.isArray(input) ? input : [input];
        return paths.some(path => {
            return this.$route.path.indexOf(path) === 0
        })
    },
  }    
 

}
</script>