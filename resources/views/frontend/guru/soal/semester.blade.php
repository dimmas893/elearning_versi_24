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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                    create
                                                </button>
                                            </div>
                                        </div>
                                        {{-- <a href="{{ route('kelas-masuk' ,encrypt($jadwal->id))}}" class="btn btn-success">Kembali</a> --}}
                                    </form>
                                    {{-- {{ $mata_pelajaran }}
                                    {{ $category_soal }} --}}
                                       <div class="table-responsive">    
                                           <table class="table table-hover">
                                               <thead>
                                                   <td>no</td>
                                                   <td>mata pelajaran</td>
                                                   <td>action</td>
                                                </thead>
                                                <tbody>
                                                    <h3>Data mata pelajaran</h3>
                                                    @foreach($semester as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->name }}</td>
                                                        <td><a href="/soal/{{encrypt($p->id)}}/{{encrypt($category_soal->id)}}/{{encrypt($mata_pelajaran->id)}}" class="btn btn-success">Pilih Mata Pelajaran</a></td>
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