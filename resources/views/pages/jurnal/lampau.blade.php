<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>{{ $app->shortName }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">



    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Selamat datang, <strong><i>{{ $cek->nama }}</strong></i> <a href="/jurnal/logout"
                        class="btn btn-sm btn-warning btn-block mb-4"><b>Logout</b></a></h2>
                <a href="/jurnal" class="btn btn-md btn-danger">Jurnal KBM</a>
                <a href="/guru/profil" class="btn btn-md btn-success">Update Profil PTK</a>
               <p></p>
                <?php
                use Carbon\Carbon;
                setlocale(LC_TIME, 'id_ID');
                \Carbon\Carbon::setLocale('id');
                \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y');
                $today = Carbon::now()->isoFormat('dddd, D MMM Y ');
                echo 'Hari ini : ' . $today . ' ' . date('H:i:s');
                ?>
            </div>
            @if ($skrg == 0 || $skrg == 6)
                <div class="row g-5">
                    <div class="col-md-12 col-lg-12">
                        <div class="alert alert-danger">
                            "Belum saatnya mengisi Jurnal, ini hari libur. Selamat beristirahat...."
                        </div>
                    </div>
                </div>
            @else
                <div class="row g-5">
                    <div class="col-md-12 col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('sukses'))
                            <div class="alert alert-success">
                                {{ session('sukses') }}
                            </div>
                        @endif
                        <form class="needs-validation" action="/jurnal/store/umum" method="post" name="frmImage"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_guru" value="{{ $cek->id }}">
                            <input type="hidden" name="id_status" value="1">
                            <input type="hidden" name="juml" value="0">
                            <input type="hidden" name="hadir" value="0">
                            <div class="col-md-12 input-group">
                                <h2>Form Isian Jurnal Kegiatan Umum</h2>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <label for="state" class="form-label">Tanggal Kegiatan</label>
                                <input class="form-control" type="date" name="tanggal" value="{{ $tanggal }}">
                            </div>
                            <p></p>
                            <div class="col-md-12">
                                <label for="country" class="form-label">Kelas</label>
                                <select class="form-select" id="country" name="id_kls" required>
                                    <option value="">Pilih...</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p></p>
                            <label for="state" class="form-label">Jam Ke .. Sampai .. :</label>
                            <div class="col-md-12 input-group">
                                <select class="form-select" id="state" name="dari" required>
                                    <option value="">Pilih...</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <label for="state" class="form-label">&nbsp; - &nbsp;</label>
                                <select class="form-select" id="state" name="ke" required>
                                    <option value="">Pilih...</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <input type="hidden" name="id_jp" value="{{ $skrg }}">
                            <p></p>
                            <div class="col-md-12">
                                <label for="state" class="form-label">Mata Pelajaran / Kegiatan</label>
                                <select class="form-select" id="state" name="id_mapel" required>
                                    <option value="">Pilih...</option>
                                    @foreach ($mapel as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p></p>

                            <div class="col-md-12">
                                <label for="state" class="form-label">Lokasi Belajar / Kegiatan</label>
                                <select class="form-select" id="state" name="id_lokasi" required>
                                    <option value="">Pilih...</option>
                                    @foreach ($lokasi as $l)
                                        <option value="{{ $l->id }}">{{ $l->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p></p>
                            <div class="col-md-12">
                                <label for="exampleFormControlTextarea1" class="form-label">Uraian Kegiatan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="ket" required></textarea>
                            </div>
                            <p></p>
                            <div class="col-md-12">
                                <label for="formFile" class="form-label">Lampiran Foto <code>***</code></label>
                                <input class="form-control" type="file" id="formFile" name="foto"
                                    accept=".jpg, .jpeg, .png">
                            </div>
                            <div class="col-md-12">
                                <label for="formFile" class="form-label"><code>*** : Harap melampirkan foto anda &
                                        siswa
                                        di dalam kelas</code></label>
                            </div>
                    </div>

                    <button class="w-100 btn btn-primary btn-lg" type="submit" name="submit">Kirim Laporan
                        Kegiatan</button>
                    </form>
                </div>
            @endif

    </div>

    </main>
    <p>
    <p>
        <hr>
    <div class="container">
        <h2>Riwayat KBM</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col"></th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam Ke</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Mapel</th>
                    <th scope="col">Lokasi Belajar</th>
                    <th scope="col">Uraian</th>
                    <th scope="col">Jumlah Siswa</th>
                    <th scope="col">Hadir</th>
                    <th scope="col">Tidak Hadir</th>

                </tr>
            </thead>
            <tbody>

                @php
                    $i = 1;
                @endphp
                @foreach ($kbm as $k)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>

                            <form action="{{ route('jurnal.destroy') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $k->id }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Yakin menghapus data?')">Hapus</button>
                            </form>

                        </td>
                        <td>{{ $k->tanggal }}</td>
                        <td>
                            @php
                                if ($k->id_jp <= 10) {
                                    echo $k->id_jp;
                                } else {
                                    $jp = substr($k->id_jp, 1);
                                    if ($jp <= 0) {
                                        $jp = 10;
                                    } else {
                                        $jp = $jp;
                                    }
                                    echo $jp;
                                }
                            @endphp
                        </td>
                        <td>{{ $k->nama_kelas }}</td>
                        <td>{{ $k->nama_mapel }}</td>
                        <td>{{ $k->nama_lokasi }}</td>
                        <td>{{ $k->ket }}</td>
                        <td>{{ $k->juml }}</td>
                        <td>{{ $k->hadir }}</td>
                        <td>{{ $k->juml - $k->hadir }}</td>

                        @php
                            $i++;
                        @endphp
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">{{ $app->shortName }} &copy; {{ $app->year }} - Develop By {{ $app->dev }}</p>
    </footer>
    </div>


</body>

</html>
