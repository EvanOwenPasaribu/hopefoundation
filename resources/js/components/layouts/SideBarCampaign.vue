<template>
    <div class="col-md-3">
        <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="campagin-picture text-center">
                <img :src="'/images/sample/campaign.png'" class="img-fluid">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    Judul
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <button type="button" class="btn btn-danger btn-sm">Lihat Penggalangan</button>
                <button type="button" class="btn btn-success btn-sm">Edit</button>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
                <ul class="nav">
                    <li class="active">
                        <a href="#">
                            <div class="width100">
                                Overview
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="width100">
                                Tulis Update
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="/" data-toggle="dropdown">
                            <div class="width100">
                                Donatur
                            </div> 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="">List Donatur</a></li>
                            <li><a href="">Donasi Offline</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/" data-toggle="dropdown">
                            <div class="width100">
                                Pencairan Dana
                            </div> 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="">Riwayat Pencairan</a></li>
                            <li><a href="">Cairkan Dana</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END MENU -->
        </div>
    </div>
</template>
