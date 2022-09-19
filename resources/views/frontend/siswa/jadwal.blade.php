@extends('layouts.template_siswa')
@section('contents')
		<div class="row">
			@foreach ($jadwals as $p)
			            <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-center text-uppercase mb-1">
                                                Jadwal <i class="fa-brands fa-readme"></i></div>
                                            <div class="h5 mb-0 text-center font-weight-bold text-gray-800">{{ $p->kelas->kelas }}</div> <hr>
                                            <div class="h5 mb-0 text-center font-weight-bold text-gray-800">Pengajar : {{ $p->guru->name }}</div> <hr>
                                            <div class="h5 mb-0 text-center font-weight-bold text-gray-800">Mata Pelajaran : {{ $p->mata_pelajaran->name }}</div> <hr>
                                            <div class="h5 mb-0 text-center font-weight-bold text-gray-800">Hari : {{ $p->hari->name }}</div> <hr>
                                            <div class="h5 mb-0 text-center font-weight-bold text-gray-800">Jam Masuk : {{ $p->jam_masuk }}</div> <hr>
                                            <div class="h5 mb-0 text-center font-weight-bold text-gray-800">Jam Keluar : {{ $p->jam_keluar }}</div> <hr>
											<div class="pricing-cta text-center">
												@if (\Carbon\Carbon::now('Asia/Jakarta')->format('H:i') >= $p->jam_masuk && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') <= $p->jam_keluar && $p->hari->name == \Carbon\Carbon::now()->isoFormat('dddd'))
												<a class="btn btn-primary" href="{{ route('kelas-masuk-siswa' ,encrypt($p->id))}}">Masuk Pelajaran<i
													class="ml-2 fas fa-arrow-right"></i></a>
												@else
													<button class="btn btn-danger first">Pelajaran Belum Dimulai<i class="ml-2 fas fa-arrow-right"></i></button>
												@endif
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
			@endforeach
		</div>
@endsection

	@section('js')
	<script>
			document.querySelector(".first").addEventListener('click', function(){
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Jam Pelajaran Belum Dimulai!',
				})
			});
	</script>
	<!-- JS Libraies -->
	@endsection	