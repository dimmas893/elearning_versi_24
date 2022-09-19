@extends('layouts.template_guru')
@section('contents')
            <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <form action="{{ route('cari_materi_filter', encrypt($jadwal->id)) }}" method="get" class="site-block-top-search" >
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
                                                    @foreach($semester as $p)
                                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary mt-2 mb-2" value="cari">
                                        <a href="{{ route('kelas-masuk' ,encrypt($jadwal->id))}}" class="btn btn-success">Kembali</a>
                                    </form>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <td>judul</td>
                                                <td>type</td>
                                                <td>file or link</td>
                                                <td>description</td>
                                                <td>semester</td>
                                                <td>tahun ajaran</td>
                                                <td>pertemuan</td>
                                                <td>tanggal</td>
                                                {{-- <td>Action</td> --}}
                                            </thead>
                                            <tbody>
                                                <h1>Materi hari ini</h1>
                                                @foreach($cari_materi_filter as $p)
                                                    <tr>
                                                        <td>{{ $p->judul }}</td>
                                                        <td>{{ $p->type }}</td>
                                                        <td>{{ $p->file_or_link}}</td>
                                                        <td>{{ $p->description }}</td>
                                                        <td>{{ $p->semester }}</td>
                                                        <td>{{ $p->tahun_ajaran }}</td>
                                                        <td>{{ $p->pertemuan }}</td>
                                                        <td>{{ $p->tanggal }}</td>
                                                        {{-- <td><button class="btn btn-success">Link</button></td> --}}
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
@endsection