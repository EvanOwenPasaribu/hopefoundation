import Vue from 'vue'
import Router from 'vue-router'
import welcomecontent from './../components/pengunjung/Welcome.vue';
import notfound from './../components/layouts/NotFound.vue';
import login from './../components/pengunjung/Login.vue';
import register from './../components/pengunjung/Register.vue';
import verifyemail from './../components/pengunjung/VerifyEmail.vue';
import resendtoken from './../components/pengunjung/KirimUlangToken.vue';
import resetpassword from './../components/pengunjung/LupaKataSandi.vue';
import resetchangepassword from './../components/pengunjung/ResetChangePassword.vue';
import detailcampaign from './../components/pengunjung/DetailCampaign.vue';
import fundraiserdetail from './../components/pengunjung/FundraiserDetail.vue';
import donasisekarang from './../components/pengunjung/DonasiSekarang.vue';
import profile from './../components/donatur/Profile.vue';
import donasisaya from './../components/donatur/DonasiSaya.vue';
import campaignsaya from './../components/donatur/CampaignSaya.vue';
import galangdana from './../components/fundraiser/GalangDana.vue';
import detailcampaigndashboard from './../components/donatur/DetailCampaignDashboardOverview.vue';
import detailcampaignupdate from './../components/donatur/DetailCampaignDashboardTulisUpdate.vue';
import fundraisingproduct from './../components/pengunjung/FundraisingProduct.vue';
import detailfundraising from './../components/pengunjung/DetailFundraising.vue';
import homeusers from './../components/admin/Index.vue';
import contactus from './../components/pengunjung/ContactUs.vue';
import event from './../components/pengunjung/Event.vue';
import detailevent from './../components/pengunjung/DetailEvent.vue';
import campaign from './../components/pengunjung/AllCampaign.vue';
import programkerja from './../components/pengunjung/ProgramKerja.vue';
import detailprogramkerja from './../components/pengunjung/DetailProgramKerja.vue';
import isibalance from './../components/donatur/IsiSaldo.vue';
import detailtransfer from './../components/donatur/DetailTransfer.vue';
import adminevents from './../components/admin/kegiatan/DataKegiatan.vue';
import addevents from './../components/admin/kegiatan/TambahDataKegiatan.vue';
import editevents from './../components/admin/kegiatan/EditDataKegiatan.vue';
import admindetailevents from './../components/admin/kegiatan/DetailKegiatan.vue';
import templatewebsite from './../components/admin/WebsiteSetting.vue';
import profilewebsite from './../components/pengunjung/ProfileWebsite.vue';
import adminprogramkerjas from './../components/admin/programkerja/DataProgramKerja.vue';
import addprogramkerjas from './../components/admin/programkerja/TambahDataProgramKerja.vue';
import editprogramkerjas from './../components/admin/programkerja/EditDataProgramKerja.vue';
import admindetailprogramkerjas from './../components/admin/programkerja/DetailProgramKerja.vue';
import adminprogramkerjacategorys from './../components/admin/programkerjacategory/DataProgramKerjaCategory.vue';
import addprogramkerjacategorys from './../components/admin/programkerjacategory/TambahDataProgramKerjaCategory.vue';
import editprogramkerjacategorys from './../components/admin/programkerjacategory/EditDataProgramKerjaCategory.vue';
import adminfundraisingproducts from './../components/admin/fundraisingproduct/DataFundraisingProduct.vue';
import adminaddfundraisingproducts from './../components/admin/fundraisingproduct/AddDataFundraisingProduct.vue';
import admingalangdana from './../components/admin/galangdana/DataGalangDana.vue';
import addgalangdanas from './../components/admin/galangdana/TambahDataGalangDana.vue';
import admindonatur from './../components/admin/donatur/DataDonatur.vue';
import admininformasikesehatans from './../components/admin/informasikesehatan/DataInformasiKesehatan.vue';
import addinformasikesehatans from './../components/admin/informasikesehatan/TambahDataInformasiKesehatan.vue';
import editinformasikesehatans from './../components/admin/informasikesehatan/EditDataInformasiKesehatan.vue';
import admindetailinformasikesehatans from './../components/admin/informasikesehatan/DetailInformasiKesehatan.vue';
import informasikesehatan from './../components/pengunjung/InformasiKesehatan.vue';
import detailinformasikesehatan from './../components/pengunjung/DetailInformasiKesehatan.vue';
import detaildokter from './../components/pengunjung/DetailDokter.vue';
import detailrumahsakit from './../components/pengunjung/DetailRumahSakit.vue';
import vaksinisasi from './../components/pengunjung/Vaksinisasi.vue';
import cektanggalvaksin from './../components/pengunjung/CekTanggalVaksin.vue';
import tutupsementara from './../components/pengunjung/TutupSementara.vue';

import adminverifikasigalangdana from './../components/admin/verifikasi/verifikasigalangdana/DataVerifikasiGalangDana.vue';
import adminverifikasitransferdana from './../components/admin/verifikasi/verifikasitransferdana/DataVerifikasiTransferDana.vue';
import adminverifikasisaldo from './../components/admin/verifikasi/verifikasiisisaldo/DataVerifikasiSaldo.vue';
import admindokters from './../components/admin/informasikesehatan/DataDokter.vue';
import adddokters from './../components/admin/informasikesehatan/TambahDataDokter.vue';
import editdokters from './../components/admin/informasikesehatan/EditDataDokter.vue';
import admindetaildokters from './../components/admin/informasikesehatan/DetailDokter.vue';
import adminrsdankliniks from './../components/admin/informasikesehatan/DataRSdanKlinik.vue';
import addrumahsakits from './../components/admin/informasikesehatan/TambahDataRumahSakit.vue';
import editrumahsakits from './../components/admin/informasikesehatan/EditDataRumahSakit.vue';
import admindetailrumahsakits from './../components/admin/informasikesehatan/DetailRumahSakit.vue';
import adminpendonors from './../components/admin/pendonor/DataPendonor.vue';
import addpendonors from './../components/admin/pendonor/TambahDataPendonor.vue';
import editpendonors from './../components/admin/pendonor/EditDataPendonor.vue';

import auth from './../middleware/auth';
import log from './../middleware/log';
import authafterlogin from '../middleware/authafterlogin';
import authforadmin from './../middleware/authforadmin';
import authfordonatur from './../middleware/authfordonatur';

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            name: 'welcome',
            path: '/',
            component: welcomecontent,
            meta: {
                title: 'Hope Foundation - Selamat Datang',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'login',
            path: '/auth/login',
            component: login,
            meta: {
                title: 'Hope Foundation - Login',
                middleware: [authafterlogin, log],
            }
        },
        {
            name: 'register',
            path: '/auth/register',
            component: register,
            meta: { 
                title: 'Hope Foundation - Register',
                middleware: [authafterlogin, log],
            },
        },
        {
            name: 'verifyemail',
            path: '/auth/verifyemail/:token',
            component: verifyemail,
            meta: { 
                title: 'Hope Foundation - Verify Email',
                middleware: [authafterlogin, log],
            },
        },
        {
            name: 'resendtoken',
            path: '/auth/resendtoken',
            component: resendtoken,
            meta: { 
                title: 'Hope Foundation - Kirim Ulang Token',
                middleware: [authafterlogin, log],
            },
        },
        {
            name: 'resetpassword',
            path: '/auth/resetpassword',
            component: resetpassword,
            meta: { 
                title: 'Hope Foundation - Lupa Kata Sandi',
                middleware: [authafterlogin, log],
            },
        },
        {
            name: 'resetchangepassword',
            path: '/auth/resetpassword/:tokenresetpassword',
            component: resetchangepassword,
            meta: { 
                title: 'Hope Foundation - Ubah Kata Sandi',
                middleware: [authafterlogin, log],
            },
        },
        {
            name: 'campaign',
            path: '/campaign',
            component: campaign,
            meta: { 
                title: 'Hope Foundation - Semua Penggalangan Dana',
                middleware: [authfordonatur, log],
            },
        },
        {
            name: 'detailcampaign',
            path: '/campaign/:raising_link',
            component: detailcampaign,
            meta: { 
                title: 'Hope Foundation - Detail Campaign',
                middleware: [authfordonatur, log],
            },
        },
        {
            name: 'fundraiserdetail',
            path: '/fundraiser/:idfundraiser',
            meta: { title: 'Hope Foundation - Detail Fundraiser'},
            component: fundraiserdetail
        },
        {
            name: 'donasisekarang',
            path: '/campaign/:raising_link/donasisekarang',
            component: donasisekarang,
            meta: {
                title: 'Hope Foundation - Donasi Sekarang',
                middleware: [auth, log, authfordonatur],
            }
        },
        {
            name: 'profile',
            path: '/dashboard/overview',
            meta: { title: 'Hope Foundation - Profile'},
            component: profile
        },
        {
            name: 'donasisaya',
            path: '/dashboard/donations',
            meta: { title: 'Hope Foundation - Donasi Saya'},
            component: donasisaya
        },
        {
            name: 'campaignsaya',
            path: '/dashboard/campaigns',
            meta: { title: 'Hope Foundation - Campaign Saya'},
            component: campaignsaya
        },
        {
            name: 'galangdana',
            path: '/dashboard/campaigns/registration/info',
            meta: { title: 'Hope Foundation - Galang Dana'},
            component: galangdana
        },
        {
            name: 'detailcampaigndashboard',
            path: '/dashboard/campaigns/:idcampaign/overview',
            meta: { title: 'Hope Foundation - Detail Campaign Dashboard Overview'},
            component: detailcampaigndashboard
        },
        {
            name: 'update',
            path: '/dashboard/campaigns/:idcampaign/update',
            meta: { title: 'Hope Foundation - Detail Campaign Dashboard Update'},
            component: detailcampaignupdate
        },
        {
            name: 'fundraising',
            path: '/fundraisingproduct',
            component: fundraisingproduct,
            meta: {
                title: 'Hope Foundation - Fundraising Product',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'detailfundraising',
            path: '/fundraisingproduct/:id_fundraisingproduct',
            component: detailfundraising,
            meta: {
                title: 'Hope Foundation - Detail Fundraising Product',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'homeusers',
            path: '/home',
            component: homeusers,
            meta: {
                title: 'Hope Foundation - Admin Area',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'contactus',
            path: '/contactus',
            component: contactus,
            meta: {
                title: 'Hope Foundation - Contact Us',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'event',
            path: '/event',
            component: event,
            meta: {
                title: 'Hope Foundation - Event',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'detailevent',
            path: '/event/:id_event',
            component: detailevent,
            meta: {
                title: 'Hope Foundation - Detail Event',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'programkerja',
            path: '/programkerja/:program_kerja_url',
            component: programkerja,
            meta: {
                title: 'Hope Foundation - Program Kerja',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'detailprogramkerja',
            path: '/programkerja/:program_kerja_url/:id_programkerja',
            component: detailprogramkerja,
            meta: {
                title: 'Hope Foundation - Detail Program Kerja',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'isibalance',
            path: '/isibalance',
            component: isibalance,
            meta: {
                title: 'Hope Foundation - Isi Balance',
                middleware: [auth, log, authfordonatur],
            }
        },
        {
            name: 'detailtransfer',
            path: '/detailtransfer/:id_transactionbalance',
            component: detailtransfer,
            meta: {
                title: 'Hope Foundation - Detail Transfer',
                middleware: [auth, log, authfordonatur],
            }
        },
        {
            name: 'adminevents',
            path: '/admin/dashboard/events',
            component: adminevents,
            meta: {
                title: 'Hope Foundation - Data Kegiatan',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'addevents',
            path: '/admin/dashboard/events/add',
            component: addevents,
            meta: {
                title: 'Hope Foundation - Tambah Data Kegiatan',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'editevents',
            path: '/admin/dashboard/events/:id_event/edit',
            component: editevents,
            meta: {
                title: 'Hope Foundation - Edit Data Kegiatan',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'admindetailevents',
            path: '/admin/dashboard/events/:id_event',
            component: admindetailevents,
            meta: {
                title: 'Hope Foundation - Detail Kegiatan',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'templatewebsite',
            path: '/admin/dashboard/templatewebsite',
            component: templatewebsite,
            meta: {
                title: 'Hope Foundation - Pengaturan Website',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'profilewebsite',
            path: '/profilewebsite',
            component: profilewebsite,
            meta: {
                title: 'Hope Foundation - Profile Website',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'adminprogramkerjas',
            path: '/admin/dashboard/programkerjas',
            component: adminprogramkerjas,
            meta: {
                title: 'Hope Foundation - Data Program Kerja',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'addprogramkerjas',
            path: '/admin/dashboard/programkerjas/add',
            component: addprogramkerjas,
            meta: {
                title: 'Hope Foundation - Tambah Data Program Kerja',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'editprogramkerjas',
            path: '/admin/dashboard/programkerjas/:id_programkerja/edit',
            component: editprogramkerjas,
            meta: {
                title: 'Hope Foundation - Edit Data Program Kerja',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'admindetailprogramkerjas',
            path: '/admin/dashboard/programkerjas/:id_programkerja',
            component: admindetailprogramkerjas,
            meta: {
                title: 'Hope Foundation - Detail Program Kerja',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'adminprogramkerjacategorys',
            path: '/admin/dashboard/programkerjacategorys',
            component: adminprogramkerjacategorys,
            meta: {
                title: 'Hope Foundation - Data Program Kerja Category',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'addprogramkerjacategorys',
            path: '/admin/dashboard/programkerjacategorys/add',
            component: addprogramkerjacategorys,
            meta: {
                title: 'Hope Foundation - Tambah Data Program Kerja Category',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'editprogramkerjacategorys',
            path: '/admin/dashboard/programkerjacategorys/:id_programkerjacategory/edit',
            component: editprogramkerjacategorys,
            meta: {
                title: 'Hope Foundation - Edit Data Program Kerja Category',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'adminfundraisingproducts',
            path: '/admin/dashboard/fundraisingproducts',
            component: adminfundraisingproducts,
            meta: {
                title: 'Hope Foundation - Data Fundraising Product',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'adminaddfundraisingproducts',
            path: '/admin/dashboard/addfundraisingproducts',
            component: adminaddfundraisingproducts,
            meta: {
                title: 'Hope Foundation - Add Data Fundraising Product',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'admingalangdana',
            path: '/admin/dashboard/galangdana',
            component: admingalangdana,
            meta: {
                title: 'Hope Foundation - Data Galang Dana',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'addgalangdanas',
            path: '/admin/dashboard/galangdana/add',
            component: addgalangdanas,
            meta: {
                title: 'Hope Foundation - Tambah Data Penggalangan Dana',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'admindonatur',
            path: '/admin/dashboard/donaturs',
            component: admindonatur,
            meta: {
                title: 'Hope Foundation - Data Donatur',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'admininformasikesehatans',
            path: '/admin/dashboard/informasikesehatans',
            component: admininformasikesehatans,
            meta: {
                title: 'Hope Foundation - Informasi Kesehatan',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'admindokters',
            path: '/admin/dashboard/dokters',
            component: admindokters,
            meta: {
                title: 'Hope Foundation - Dokter',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'adminrsdankliniks',
            path: '/admin/dashboard/rumahsakits',
            component: adminrsdankliniks,
            meta: {
                title: 'Hope Foundation - RS & Klinik',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'addinformasikesehatans',
            path: '/admin/dashboard/informasikesehatans/add',
            component: addinformasikesehatans,
            meta: {
                title: 'Hope Foundation - Tambah Data Informasi Kesehatan',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'editinformasikesehatans',
            path: '/admin/dashboard/informasikesehatans/:id_informasikesehatan/edit',
            component: editinformasikesehatans,
            meta: {
                title: 'Hope Foundation - Edit Data Informasi Kesehatan',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'admindetailinformasikesehatans',
            path: '/admin/dashboard/informasikesehatans/:id_informasikesehatan',
            component: admindetailinformasikesehatans,
            meta: {
                title: 'Hope Foundation - Detail Informasi Kesehatan',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'addrumahsakits',
            path: '/admin/dashboard/rumahsakits/add',
            component: addrumahsakits,
            meta: {
                title: 'Hope Foundation - Tambah Data Rumah Sakit & Klinik',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'editrumahsakits',
            path: '/admin/dashboard/rumahsakits/:id_rumahsakit/edit',
            component: editrumahsakits,
            meta: {
                title: 'Hope Foundation - Edit Data Rumah Sakit',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'admindetailrumahsakits',
            path: '/admin/dashboard/rumahsakits/:id_rumahsakit',
            component: admindetailrumahsakits,
            meta: {
                title: 'Hope Foundation - Detail Informasi Kesehatan',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'adddokters',
            path: '/admin/dashboard/dokters/add',
            component: adddokters,
            meta: {
                title: 'Hope Foundation - Tambah Data Dokter',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'editdokters',
            path: '/admin/dashboard/dokters/:id_dokter/edit',
            component: editdokters,
            meta: {
                title: 'Hope Foundation - Edit Data Dokter',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'admindetaildokters',
            path: '/admin/dashboard/dokters/:id_dokter',
            component: admindetaildokters,
            meta: {
                title: 'Hope Foundation - Detail Dokter',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'informasikesehatan',
            path: '/informasikesehatan',
            component: informasikesehatan,
            meta: { 
                title: 'Hope Foundation - Informasi Kesehatan',
                middleware: [authfordonatur, log],
            },
        },
        {
            name: 'detailinformasikesehatan',
            path: '/informasikesehatan/:id_informasikesehatan',
            component: detailinformasikesehatan,
            meta: {
                title: 'Hope Foundation - Detail Informasi Kesehatan',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'detaildokter',
            path: '/dokter/:id_dokter',
            component: detaildokter,
            meta: {
                title: 'Hope Foundation - Detail Dokter',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'detailrumahsakit',
            path: '/rumahsakit/:id_rumahsakit',
            component: detailrumahsakit,
            meta: {
                title: 'Hope Foundation - Detail Rumah Sakit',
                middleware: [authfordonatur, log],
            }
        },
        {
            name: 'adminverifikasigalangdana',
            path: '/admin/dashboard/verifikasigalangdana',
            component: adminverifikasigalangdana,
            meta: { 
                title: 'Hope Foundation - Data Verifikasi Galang Dana',
                middleware: [auth,log,authforadmin],
            },
        },
        {
            name: 'adminverifikasitransferdana',
            path: '/admin/dashboard/verifikasitransferdana',
            component: adminverifikasitransferdana,
            meta: { 
                title: 'Hope Foundation - Data Verifikasi Transfer Dana',
                middleware: [auth,log,authforadmin],
            },
        },
        {
            name: 'adminverifikasisaldo',
            path: '/admin/dashboard/verifikasisaldo',
            component: adminverifikasisaldo,
            meta: { 
                title: 'Hope Foundation - Data Verifikasi Saldo',
                middleware: [auth,log,authforadmin],
            },
        },
        {
            name: 'adminpendonors',
            path: '/admin/dashboard/pendonors',
            component: adminpendonors,
            meta: {
                title: 'Hope Foundation - Data Pendonor',
                middleware: [auth,log,authforadmin],
            }
        },
        {
            name: 'addpendonors',
            path: '/admin/dashboard/pendonors/add',
            component: addpendonors,
            meta: {
                title: 'Hope Foundation - Tambah Data Pendonor',
                middleware: [auth, log,authforadmin],
            }
        },
        {
            name: 'editpendonors',
            path: '/admin/dashboard/pendonors/:id_pendonor/edit',
            component: editpendonors,
            meta: {
                title: 'Hope Foundation - Edit Data Pendonor',
                middleware: [auth,log,authforadmin],
            }
        },
        //{
            //name: 'vaksinisasi',
            //path: '/vaksinasi',
            //component: tutupsementara,
            //meta: { 
                //title: 'Hope Foundation - Vaksinasi',
                //middleware: [authfordonatur, log],
            //},
        //},
        {
            name: 'cektanggalvaksin',
            path: '/cektanggalvaksin',
            component: cektanggalvaksin,
            meta: { 
                title: 'Hope Foundation - Cek Tanggal Vaksin',
                middleware: [authfordonatur, log],
            },
        },
        {
            name: 'notfound',
            path: '/notfound',
            meta: { title: 'Hope Foundation - Not Found'},
            component: notfound
        },
    ],
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
});
// Creates a `nextMiddleware()` function which not only
// runs the default `next()` callback but also triggers
// the subsequent Middleware function.
function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;
    
    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({ ...context, next: nextMiddleware });
    };
}
    
router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        document.title = to.meta.title
        const middleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];
        
        const context = {
            from,
            next,
            router,
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);
        return middleware[0]({ ...context, next: nextMiddleware });
    }
    document.title = to.meta.title
    return next();
});

export default router;
