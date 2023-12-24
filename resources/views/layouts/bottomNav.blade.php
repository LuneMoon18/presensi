<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="/dashboard" class="item {{request()->is('dashboard') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="home" style="color: #F1F1F1;"></ion-icon>
            <strong style="color: #F1F1F1;">Beranda</strong>
        </div>
    </a>
    <a href="/presensi/riwayat" class="item {{request()->is('presensi/riwayat') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated" aria-label="document text outline"
                style="color: #F1F1F1;"></ion-icon>
            <strong style="color: #F1F1F1;">Riwayat</strong>
        </div>
    </a>
    <a href="/presensi/create" class="item{{request()->is('presensi/create') ? 'active' : ''}}">
        <div class="col">
            <div class="action-button large" style="background-color: #23120B;">
                <ion-icon name="checkbox-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="/presensi/izin" class="item {{request()->is('presensi/izin') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated" aria-label="document text outline"
                style="color: #F1F1F1;"></ion-icon>
            <strong style="color: #F1F1F1;">Izin</strong>
        </div>
    </a>
    <a href="/editprofil" class="item {{request()->is('editprofil') ? 'active' : ''}}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"
                style="color: #F1F1F1;"></ion-icon>
            <strong style="color: #F1F1F1;">Profil</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->