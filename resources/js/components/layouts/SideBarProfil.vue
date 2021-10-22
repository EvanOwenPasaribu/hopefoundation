<template>
    <div class="col-md-3">
        <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic text-center">
                <img :src="'/images/sample/logo.jpg'" class="img-fluid-border">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    Andi
                </div>
                <div class="profile-usertitle-job">
                    andilovedesign@gmail.com
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <button type="button" class="btn btn-success btn-sm">Edit Profile</button>
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
                                Verifikasi Akun
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="width100">
                                Campaign Saya
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="width100">
                                Donasi Saya
                            </div> 
                        </a>
                    </li>
                    <li>
                        <a href="/" data-toggle="dropdown">
                            <div class="width100">
                                Akun Saya
                            </div> 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="">Ubah Password</a></li>
                            <li><a href="">Ubah Profile Picture</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/" data-toggle="dropdown">
                            <div class="width100">
                                Dompet Kebaikan
                            </div> 
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="">Mutasi</a></li>
                            <li><a href="">Tambah Deposit</a></li>
                            <li><a href="">Pencairan Dana</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END MENU -->
        </div>
    </div>
</template>
