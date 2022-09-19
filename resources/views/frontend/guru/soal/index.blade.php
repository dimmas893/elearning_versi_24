@extends('layouts.template_guru')
@section('contents')
<div>
    <div class="card card-body">
        <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-body">
                                    {{-- <form action="{{ route('cari_ujian_filter', encrypt($jadwal->id)) }}" method="get" class="site-block-top-search" > --}}
                                        @csrf
                                        
                                        {{-- <input type="hidden" value="{{ $jadwal->id }}" name='jadwal_id'>  --}}
                                        <div class="row">
                                            <div class="col-3">
                                                <label>pilih tahun ajaran</label>
                                                <select class="form-control" name="tahun_ajaran" id="tahun_ajaran">
                                                    <option class="form-control" value="2020">2020</option>
                                                    <option class="form-control" value="2021">2021</option>
                                                    <option class="form-control" value="2022">2022</option>
                                                    <option class="form-control" value="2023">2023</option>
                                                    <option class="form-control" value="2024">2024</option>
                                                    <option class="form-control" value="2025">2025</option>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label>pilih semester</label>
                                                <select class="form-control" name="semester" id="semester">
                                                    {{-- @foreach($semester as $p)
                                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                            
                                            <div class="col-3 mt-4">
                                                <input type="submit" class="btn btn-primary mt-2 mb-2" value="cari">
                                            </div>
                                            <div class="col-3 text-right mt-4">
                                                <form action="/soal/export" method="get">
                                                @csrf
                                                    <input type="hidden" value="{{ Auth::guard('guru')->user()->id }}" name="guru_id">
                                                    <input type="hidden" value="{{ $category_soal->id }}" name="category_soal_id">
                                                    <input type="hidden" value="{{ $category_soal->kelas->id }}" name="kelas_id">
                                                    <input type="hidden" value="{{ $mata_pelajaran->id }}" name="mata_pelajaran_id">
                                                    {{-- <input type="hidden" value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y') }}" name="tahun_ajaran"> --}}
                                                    <input type="hidden" value="{{ $semestersemester->id }}" name="semester_id">

                                                    <input type="submit" class="btn btn-success" value="mentahan excel">
                                                </form>
                                        </div>
                                        {{-- <a href="{{ route('kelas-masuk' ,encrypt($jadwal->id))}}" class="btn btn-success">Kembali</a> --}}
                                    {{-- </form> --}}
                                    <form action="{{ route('soal-import') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <input type="hidden" value="{{ Auth::guard('guru')->user()->id }}" name="guru_id">
                                        <input type="hidden" value="{{ $category_soal->id }}" name="category_soal_id">
                                        <input type="hidden" value="{{ $category_soal->kelas->id }}" name="kelas_id">
                                        <input type="hidden" value="{{ $mata_pelajaran->id }}" name="mata_pelajaran_id">
                                        <input type="hidden" value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y') }}" name="tahun_ajaran">
                                        <input type="hidden" value="{{ $semestersemester->id }}" name="semester_id">
                                        <input type="hidden" value="{{\Carbon\Carbon::now()->isoFormat('D MMM Y')}}" name="tanggal">
                                        {{-- {{$category_soal->kelas_id}} --}}
                                        <div class="input-group mb-3">
                                            <input type="file" name="file" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn btn-primary" type="submit" id="button-addon2">Import</button>
                                        </div>
                                    </form>
                                    {{-- {{\Carbon\Carbon::now('Asia/Jakarta')->format('Y')}} --}}
                                       <div class="table-responsive mt-4">    
                                           <table class="table table-hover">
                                               <thead>
                                                   <td>No</td>
                                                   {{-- <td>Guru</td> --}}
                                                   {{-- <td>file</td> --}}
                                                   <td>soal</td>
                                                   <td>opsi a</td>
                                                   <td>opsi b</td>
                                                   <td>opsi c</td>
                                                   <td>opsi d</td>
                                                   <td>jawaban</td>
                                                   {{-- <td>action</td> --}}
                                                </thead>
                                                <tbody>
                                                    <h3>Data Soal {{ $mata_pelajaran->name }} || {{ $category_soal->kelas->kelas }} || {{ $category_soal->name }} || {{ $semestersemester->name }}</h3>
                                                    @foreach($soal as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        {{-- <td>{{ $p->guru->name }}</td> --}}
                                                        {{-- <td>{{ $p->file }}</td> --}}
                                                        <td>{{ $p->soal }}</td>
                                                        <td>{{ $p->opsi_a }}</td>
                                                        <td>{{ $p->opsi_b }}</td>
                                                        <td>{{ $p->opsi_c }}</td>
                                                        <td>{{ $p->opsi_d }}</td>
                                                        <td>{{ $p->jawaban }}</td>
                                                        {{-- <td><a href="" class="btn btn-primary">Edit</a></td> --}}
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


    </div>
        @endsection