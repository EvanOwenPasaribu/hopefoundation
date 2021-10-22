export default {
    methods: {
        handlerException:function (res) {
            if(res.response.data.message == "Token is Invalid" || res.response.data.message == "Token is Expired" || res.response.data.message == "Token is Not Found" || res.response.data.message == "The token could not be parsed from the request")
            {
                this.$swal({
                    position: 'top-end',
                    type: 'error',
                    title: res.response.data.message,
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true
                });
                localStorage.removeItem('loggedin')
                localStorage.removeItem('usertoken')
                localStorage.removeItem('userstatus')
                window.location.href = '/auth/login'
            }
            else if(res.response.data.message == "Data masih kosong")
            {
            }
            else if(res.response.data.message == "Token sudah expired")
            {
                this.$swal({
                    position: 'top-end',
                    type: 'error',
                    title: res.response.data.message,
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true
                });
                this.$router.push({ name: 'welcome' })
            }
            else if(res.response.data.message == "Data tidak ditemukan")
            {
                this.$router.push({ name: 'notfound' })
            }
            else if(res.response.data.message == "")
            {
                this.$swal({
                    position: 'top-end',
                    type: 'error',
                    title: 'Terjadi Kesalahan Pada Inputan Anda',
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true
                });
                this.errors = res.response.data.errors;
            }
            else
            {
                this.$swal({
                    position: 'top-end',
                    type: 'error',
                    title: res.response.data.message,
                    showConfirmButton: false,
                    timer: 5000,
                    toast: true
                });
            }
        }
    }
}