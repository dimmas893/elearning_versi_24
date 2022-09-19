
@extends('layouts.template_admin')
@section('content')

<x-alert />
                    <div class="col mb-4 mb-lg-0 text-center">
                            <i data-feather="book-open" style="width: 80px; height: 60px; color: #6c757d"></i>
                                <h6 class="badge badge-dark"></h6><br>
                                <!-- Button trigger modal -->
                                <form action="{{route('raport_create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                      <div class="row">
                                        <div class="col-4">
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
                                        <div class="row">
                                            <div class="col-4">
                                                <label>pilih semester</label>
                                                <select class="form-control" name="semester" id="semester">
                                                    @foreach($semester as $p)
                                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4 mt-4">
                                            {{-- <input type="submit" class="btn btn-primary mt-2 mb-2" value="cari"> --}}
                                            {{-- <a href="" class="btn btn-success mt-2 mb-2" value="cari"> </a> --}}
                                            <input class="btn btn-primary" type="submit" value="buat">
                                        </div>
                                    </div>
                                    {{-- <input type="hidden" value="4" name='kelas_id'>  --}}
                                </form>
                    </div>
@endsection