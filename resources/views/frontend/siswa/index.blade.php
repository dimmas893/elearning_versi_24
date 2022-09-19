@extends('layouts.template_siswa')
@section('contents')
            <div class="row">
        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total siswa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa }}</div>
                                        </div>
                                        <div class="col-auto">  
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Guru</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guru }}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-regular fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                                <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Wali Guru</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guru_kelas }}</div>
                                        </div>
                                        <div class="col-auto">
                                           
                                           <i class="fa-regular fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                                <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Kelas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kelas }}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-solid fa-shop"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
@endsection