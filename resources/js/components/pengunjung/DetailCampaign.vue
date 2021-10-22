<template>
    <div>
        <div class="container addpaddingtop">
            <h2><b>{{ campaigns.campaigns_title }}</b></h2>
            <div class="row">
                <div class="col-md-7">
                    <img :src="campaigns.campaigns_foto" class="img-fluid">
                    <h4 class="text-justify">{{ campaigns.short_invitation }}</h4>
                </div>
                <div class="col-md-5">
                    <div class="project-status">
                        <h2><b>Biaya Target</b></h2>
                        <h5>terkumpul dari Rp. {{ formatPrice(campaigns.target_funds) }}</h5>
                        <span class="project-bar-progress" :style="{width:campaigns.funds_collected/campaigns.target_funds * 100 + '%'}"></span>
                        <div class="row project-goal">
                            <div class="col-sm">
                                <h6 class="text-black-100"><b>{{ campaigns.funds_collected/campaigns.target_funds * 100 }}</b>% tercapai</h6>
                            </div>
                            <div class="col-sm text-right">
                                <h6 class="text-black-100"><b>{{workingDaysBetweenDates(formatDate(datenow, "yyyy-MM-dd"), campaigns.raising_deadline, false)}}</b> hari lagi</h6>
                            </div>
                        </div>
                        <div class="row project-button">
                            <router-link class="btn btn-primary py-3 px-4" :to="{ name: 'donasisekarang', params: { raising_link: campaigns.raising_link }}">DONASI SEKARANG</router-link>
                        </div>
                        <br>
                        <br>
                        <h6 class="text-black-100">Penggalangan dana dimulai <b>{{formatDate(new Date(campaigns.created_at.split(" ")[0]),"dd MMMM yyyy")}}</b> oleh:</h6>
                        <br>
                        <a href="">
                            <div class="row">
                                <div class="col-2">
                                    <img :src="campaigns.user.logo" class="rounded-circle border-all">
                                </div>
                                <div class="col-10 paddingtop10px">
                                    <h6 class="text-black-100"><b>{{campaigns.user.name}}</b> 
                                        <i v-if="campaigns.user.isverified == 'Y'" class="fa fa-check-circle blue"></i>
                                    </h6>
                                    <h6 v-if="campaigns.user.isverified == 'Y'">Akun Telah Diverifikasi</h6>
                                    <h6 v-else>Akun Belum Diverifikasi</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="backgroundcolorwhite">
            <section id="tabs" class="project-tab">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="borderbottomcolorgray">
                            <div class="nav nav-tabs container" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detail</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Update Campaign</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Donatur ({{campaigns.totaldonations}})</a>
                            </div>
                        </nav>
                        <div class="tab-content container" id="nav-tabContent">
                            <div v-html="campaigns.campaigns_description" class="tab-pane fade show active text-black-100 paddingtop20px" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div v-if="campaigns.updatecampaigns.length == 0" class="row padding15px">
                                    <h5>Belum ada informasi update yang ditambahkan</h5>
                                </div>
                                <div class="row update">
                                    <ul class="timeline">
                                        <li v-for="(update, uc) in campaigns.updatecampaigns" :key="uc">
                                            <p class="text-black-100"><b>{{update.title_update}}</b></p>
                                            <p class="text-black-100">Tanggal Update: {{formatDate(new Date(update.created_at.split(" ")[0]),"dd MMMM yyyy") + " " + update.updated_at.split(" ")[1]}}</p>
                                            <p v-html="update.description_update"></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div v-if="campaigns.donations.length == 0" class="row padding15px">
                                    <h5>Belum ada yang memberikan donasi</h5>
                                </div>
                                <div v-else>
                                    <div class="row donaturbox" v-for="(donatur, dc) in campaigns.donations" :key="dc">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img :src="donatur.user.logo" class="rounded-circle border-all">
                                                </div>
                                                <div class="col-10">
                                                    <h6 class="text-black-100"><b>Rp. {{ formatPrice(donatur.amount_of_donation) }}</b></h6>
                                                    <h6 class="text-black-100"><b v-if="donatur.user_is_anonim == 'Y'">Anonim</b><b v-else>{{donatur.user.name}}</b></h6>
                                                    <small style="margin-top:-20px">{{formatDate(new Date(donatur.updated_at.split(" ")[0]),"dd MMMM yyyy") + " " + donatur.updated_at.split(" ")[1]}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                path: this.$route.params.raising_link,
                datenow: new Date(),
                campaigns: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/campaigns/' + app.path).then(function (res) {
                app.campaigns = res.data.data
            })
            .catch(function (res) {
                console.log(res);
            });
        },
        methods:{
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            workingDaysBetweenDates(startDate, endDate, getWorkingDays) 
            {
                startDate = new Date(startDate);
                endDate = new Date(endDate);

                // Validate input
                if (endDate < startDate)
                    return 0;

                // Calculate days between dates
                var millisecondsPerDay = 86400 * 1000; // Day in milliseconds
                startDate.setHours(0,0,0,1);  // Start just after midnight
                endDate.setHours(23,59,59,999);  // End just before midnight
                var diff = endDate - startDate;  // Milliseconds between datetime objects
                var days = Math.ceil(diff / millisecondsPerDay);

                if(getWorkingDays){
                    // Subtract two weekend days for every week in between
                    var weeks = Math.floor(days / 7);
                    days = days - (weeks * 2);

                    // Handle special cases
                    var startDay = startDate.getDay();
                    var endDay = endDate.getDay();

                    // Remove weekend not previously removed.
                    if (startDay - endDay > 1)
                        days = days - 2;

                    // Remove start day if span starts on Sunday but ends before Saturday
                    if (startDay == 0 && endDay != 6)
                        days = days - 1;

                    // Remove end day if span ends on Saturday but starts after Sunday
                    if (endDay == 6 && startDay != 0)
                        days = days - 1;
                }
                return days;
            },
            formatDate(date, format, utc) {
                var MMMM = ["\x00", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var MMM = ["\x01", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                var dddd = ["\x02", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                var ddd = ["\x03", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

                function ii(i, len) {
                    var s = i + "";
                    len = len || 2;
                    while (s.length < len) s = "0" + s;
                    return s;
                }

                var y = utc ? date.getUTCFullYear() : date.getFullYear();
                format = format.replace(/(^|[^\\])yyyy+/g, "$1" + y);
                format = format.replace(/(^|[^\\])yy/g, "$1" + y.toString().substr(2, 2));
                format = format.replace(/(^|[^\\])y/g, "$1" + y);

                var M = (utc ? date.getUTCMonth() : date.getMonth()) + 1;
                format = format.replace(/(^|[^\\])MMMM+/g, "$1" + MMMM[0]);
                format = format.replace(/(^|[^\\])MMM/g, "$1" + MMM[0]);
                format = format.replace(/(^|[^\\])MM/g, "$1" + ii(M));
                format = format.replace(/(^|[^\\])M/g, "$1" + M);

                var d = utc ? date.getUTCDate() : date.getDate();
                format = format.replace(/(^|[^\\])dddd+/g, "$1" + dddd[0]);
                format = format.replace(/(^|[^\\])ddd/g, "$1" + ddd[0]);
                format = format.replace(/(^|[^\\])dd/g, "$1" + ii(d));
                format = format.replace(/(^|[^\\])d/g, "$1" + d);

                var H = utc ? date.getUTCHours() : date.getHours();
                format = format.replace(/(^|[^\\])HH+/g, "$1" + ii(H));
                format = format.replace(/(^|[^\\])H/g, "$1" + H);

                var h = H > 12 ? H - 12 : H == 0 ? 12 : H;
                format = format.replace(/(^|[^\\])hh+/g, "$1" + ii(h));
                format = format.replace(/(^|[^\\])h/g, "$1" + h);

                var m = utc ? date.getUTCMinutes() : date.getMinutes();
                format = format.replace(/(^|[^\\])mm+/g, "$1" + ii(m));
                format = format.replace(/(^|[^\\])m/g, "$1" + m);

                var s = utc ? date.getUTCSeconds() : date.getSeconds();
                format = format.replace(/(^|[^\\])ss+/g, "$1" + ii(s));
                format = format.replace(/(^|[^\\])s/g, "$1" + s);

                var f = utc ? date.getUTCMilliseconds() : date.getMilliseconds();
                format = format.replace(/(^|[^\\])fff+/g, "$1" + ii(f, 3));
                f = Math.round(f / 10);
                format = format.replace(/(^|[^\\])ff/g, "$1" + ii(f));
                f = Math.round(f / 10);
                format = format.replace(/(^|[^\\])f/g, "$1" + f);

                var T = H < 12 ? "AM" : "PM";
                format = format.replace(/(^|[^\\])TT+/g, "$1" + T);
                format = format.replace(/(^|[^\\])T/g, "$1" + T.charAt(0));

                var t = T.toLowerCase();
                format = format.replace(/(^|[^\\])tt+/g, "$1" + t);
                format = format.replace(/(^|[^\\])t/g, "$1" + t.charAt(0));

                var tz = -date.getTimezoneOffset();
                var K = utc || !tz ? "Z" : tz > 0 ? "+" : "-";
                if (!utc) {
                    tz = Math.abs(tz);
                    var tzHrs = Math.floor(tz / 60);
                    var tzMin = tz % 60;
                    K += ii(tzHrs) + ":" + ii(tzMin);
                }
                format = format.replace(/(^|[^\\])K/g, "$1" + K);

                var day = (utc ? date.getUTCDay() : date.getDay()) + 1;
                format = format.replace(new RegExp(dddd[0], "g"), dddd[day]);
                format = format.replace(new RegExp(ddd[0], "g"), ddd[day]);

                format = format.replace(new RegExp(MMMM[0], "g"), MMMM[M]);
                format = format.replace(new RegExp(MMM[0], "g"), MMM[M]);

                format = format.replace(/\\(.)/g, "$1");

                return format;
            }
        }
    }
</script>