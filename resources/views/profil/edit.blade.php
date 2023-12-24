<form action="/profil/{{$profil->kode_pos}}/updateprofil" method="POST" id="formProfil">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" readonly value="{{$profil->kode_pos}}" class="form-control" name="kode_pos"
                    id="kode_pos" placeholder="Kode Pos">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->nama_web}}" class="form-control" name="nama_web"
                    placeholder="Alamat Web">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->deskripsi}}" class="form-control" name="deskripsi" id="deskripsi"
                    placeholder="Deskripsi">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->no_hp}}" class="form-control" name="no_hp" id="no_hp"
                    placeholder="Nomor Telepon">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->alamat}}" class="form-control" name="alamat" id="alamat"
                    placeholder="Alamat">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->alamat_web}}" class="form-control" name="alamat_web"
                    id="alamat_web" placeholder="Alamat Web">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->nama_perusahaan}}" class="form-control" name="nama_perusahaan"
                    id="nama_perusahaan" placeholder="Nama Perusahaan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->nama_direktur}}" class="form-control" name="nama_direktur"
                    id="nama_direktur" placeholder="Nama Direktur">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <input type="text" value="{{$profil->nama_manager}}" class="form-control" name="nama_manager"
                    id="nama_manager" placeholder="Nama Manager">
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