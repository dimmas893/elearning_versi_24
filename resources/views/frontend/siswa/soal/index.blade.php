@extends('layouts.template_siswa')
@section('contents')
<div>
    <div class="card card-body">
        <div class="row">
            <div class="col-12">
                <div class="card mt-2">
                    <div class="card-body">
                          
                                <div class="table-responsive mt-4">    

                                        <div class="card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card-body">
                                                        <div>
                                                            @foreach($soal as $p)
                                                            {{-- {{ $p->total }} --}}
                                                                <div>
                                                                    {{ $loop->iteration }}. {{ $p->soal }}
                                                                    <div class="form-check" required>
                                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="{{ $p->opsi_a }}">
                                                                        <label class="form-check-label" for="exampleRadios1">
                                                                            {{ $p->opsi_a }}
                                                                        </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="{{ $p->opsi_b }}">
                                                                        <label class="form-check-label" for="exampleRadios2">
                                                                            {{ $p->opsi_b }}
                                                                        </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="{{ $p->opsi_c }}">
                                                                        <label class="form-check-label" for="exampleRadios3">
                                                                            {{ $p->opsi_c }}
                                                                        </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="{{ $p->opsi_d }}">
                                                                        <label class="form-check-label" for="exampleRadios4">
                                                                            {{ $p->opsi_d }}
                                                                        </label>
                                                                        </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


    </div>
        @endsection