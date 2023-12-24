@if($riwayat->isEmpty())
<div class="alert alert-warning">
    <p>Data Belum Ada</p>
</div>
@endif
@foreach($riwayat as $d)
<ul class="listview image-listview">
    <li>
        <div class="item">
            <div class="in">
                <div>
                    <b>{{date("d-m-Y",strtotime($d->presence_date))}}</b><br>
                </div>
                <span class="badge {{$d->time_in < " 07.00" ? "bg-success" : "bg-danger" }}">
                    {{$d->time_in}}
                </span>
                <span class="badge bg-primary">{{$d-> time_out}}</span>
            </div>
        </div>
    </li>
</ul>
@endforeach