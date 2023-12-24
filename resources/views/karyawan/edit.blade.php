<form action="/karyawan/{{$karyawan-> nip}}/update" method="POST" id="formKaryawan" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 12h3v4h-3z" />
                        <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" />
                        <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                        <path d="M14 16h2" />
                        <path d="M14 12h4" />
                    </svg>
                </span>
                <input type="text" readonly value="{{$karyawan->nip}}" class="form-control" name="nip" id="nip"
                    placeholder="Employee Code">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                    </svg>
                </span>
                <input type="text" value="{{$karyawan->nama_lengkap}}" class="form-control" name="nama_lengkap"
                    id="nama_lengkap" placeholder="Nama Lengkap">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-histogram"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 3v18h18" />
                        <path d="M20 18v3" />
                        <path d="M16 16v5" />
                        <path d="M12 13v8" />
                        <path d="M8 16v5" />
                        <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />
                    </svg>
                </span>
                <input type="text" value="{{$karyawan->jabatan}}" class="form-control" name="jabatan" id="jabatan"
                    placeholder="Jabatan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <select name="kode_divisi" id="kode_divisi" class="form-select">
                <option value="">Departemen</option>
                @foreach($divisi as $d)
                <option {{ $karyawan->kode_divisi == $d-> kode_divisi ? 'selected': ''}} value="{{$d->kode_divisi}}">
                    {{$d-> nama_divisi}}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-calling"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        <path d="M15 7l0 .01" />
                        <path d="M18 7l0 .01" />
                        <path d="M21 7l0 .01" />
                    </svg>
                </span>
                <input type="text" value="{{$karyawan->no_hp}}" class="form-control" name="no_hp" id="no_hp"
                    placeholder="Nomor Handphone">
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="mb-3">
                <div class="form-label">
                    Upload Foto
                </div>
                <input type="file" class="form-control" id="foto" name="foto">
                <input type="hidden" name="foto_lama" value="{{$karyawan->foto}}">
            </div>
        </div>
    </div>
    <div class="row Mmt-2">
        <div class="col-12">
            <div class="form-group">
                <button class="btn w-100" style="background-color: #FDB827; color: #F1F1F1;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 9l5 -5l5 5" />
                        <path d="M12 4l0 12" />
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>