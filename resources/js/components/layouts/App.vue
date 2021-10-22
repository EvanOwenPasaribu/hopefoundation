<template>
    <div>
        <div id="app">
          <Navbar :key="$route.fullPath" :user="user"></Navbar>
          <transition name="fade">
              <router-view :user="user" :templates='templates'></router-view>
          </transition>
          <Footer :key="$route.fullPath" :user="user" :templates='templates'></Footer>
        </div>
    </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>

<script>
import Navbar from './Navbar'
import Footer from './Footer'

export default {
  name: 'App',
  components: {
    'Navbar': Navbar,
    'Footer': Footer
  },
  data () {
    return {
        user: [],
        templates: []
    }
  },
  mounted(){
    this.getTemplate()
    if(localStorage.getItem('usertoken'))
      this.getUserAuth()
  },
  methods:{
    getTemplate(){
      var app = this;
      axios.get('/api/admin/templates').then(function (res) {
          app.templates = res.data.data
      })
      .catch(function (res) {
          console.log(res);
      });
    },
    getUserAuth(){
      var config = {
          headers: {
              'Authorization': "Bearer " + localStorage.usertoken
          }
      };
      var app = this;
      axios.get('/api/user',config).then(function (res) {
          app.user = res.data.data
          localStorage.setItem('loggedin', "loggedin")
      })
      .catch(function (res) {
          app.user = []
          localStorage.removeItem('loggedin')
          localStorage.removeItem('usertoken')
          localStorage.removeItem('userstatus')
          window.location.href = '/auth/login'
      });
    }
  }
}
</script>