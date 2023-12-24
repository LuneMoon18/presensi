@foreach ($absen as $d)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$d->nip}}</td>
    <td>{{$d->nama_lengkap}} </td>
    <td>{{$d->nama_divisi}}</td>
    <td>{{$d->time_in}}</td>
    <td>
        @if($d-> time_in >= '07:15')
        <span>Terlambat</span>
        @else
        <span class=>Tepat Waktu</span>
        @endif
    </td>
    <td>
        {!!$d-> time_out != null ? $d->time_out : '<span class="badge bg-danger">Belum Absen</span>' !!}
    </td>
</tr>
@endforeach