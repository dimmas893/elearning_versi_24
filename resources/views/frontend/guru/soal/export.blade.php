                                    <div class="table-responsive mt-4">    
                                           <table class="table table-hover">
                                               <thead>
                                                   {{-- <td>No</td> --}}
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
                                                    {{-- <h3>Data Soal {{ $mata_pelajaran->name }} || {{ $category_soal->kelas->kelas }} || {{ $category_soal->name }} || {{ $semestersemester->name }}</h3> --}}
                                                    @foreach($soal as $p)
                                                    <tr>
                                                        {{-- <td>{{ $loop->iteration }}</td> --}}
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