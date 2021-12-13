<template>
    <router-link :to="{ name: 'detailcampaign', params: { raising_link: campaign.raising_link }}">
        <div class="card" style="box-shadow: rgba(123, 186, 67, 0.15) 1.95px 1.95px 2.6px; border: 1px solid #7BBA43">
            <div class="crop centered card-header p-0">
                <img style="width:100%;object-fit:cover;height:100%" class='img-fluid' :src="campaign.campaigns_foto">
            </div>
            <div class="card-body p-3"> 
                <h5 class="card-title" style="color: #7BBA43"><b>{{campaign.campaigns_title}}</b></h5>
                <a href=""><p class="card-text text-black-100">{{campaign.user.name}} <i v-if="campaign.user.isverified == 'Y'" class="fa fa-check-circle blue"></i></p></a>
                <span class="project-bar-progress progressbarmargin" :style="{width:campaign.funds_collected/campaign.target_funds * 100 + '%'}"></span>
                <div class="row">
                    <div class="col-6">
                        <h6 class="text-black-100">Terkumpul<br><b>Rp. {{ formatPrice(campaign.funds_collected) }}</b></h6>
                    </div>
                    <div class="col-6 text-right">
                        <h6 class="text-black-100">Sisa Hari<br><b>{{workingDaysBetweenDates(formatDate(datenow, "yyyy-MM-dd"), campaign.raising_deadline,false)}}</b></h6>
                    </div>
                </div>
            </div>
        </div>
    </router-link>
</template>

<script>
    export default {
        mounted() {
            
        },
        data(){
            return{
                datenow: new Date(),
            }
        },
        props: ['campaign'],
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