

@section('title','Data Parkir')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-danger card-header-icon">
            <div class="row">
              <div class="col-md-12">
                <br>
                <h2 class="card-title">Laporan Parkir</h2>
              </div>
              
            <div class="material-datatables">
              <table id="dataList" class="table table-striped table-bordered table-hover dataTables" cellspacing="10" width="100%" style="width:100%">
                <thead class="bold">
                  <tr>
                    <th class="disabled-sorting">No</th>
                    <th>Jenis Kendaraan</th>
                    <th class="text-center">Harga</th>
                    <th>Plat Nomer</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Tanggal</th>
                    <th>Dibuat</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <!-- {{$no = 1}} -->
                <tbody>
                  @foreach($data as $tmp)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$tmp->jenis_kendaraan}}</td>
                    <td>Rp. {{number_format($tmp->biaya,2,',','.')}}</td>
                    <td>{{$tmp->plat_nomor}}</td>
                    <td>{{$tmp->jam_masuk}}</td>
                    <td>{{$tmp->jam_keluar}}</td>
                    <td>{{$tmp->tgl}}</td>
                    <td>{{HelperData::getDataUser($tmp->addedby,"fullname")}}</td>
                    <td>{{$tmp->status}}</td>
                    {{-- <td class="td-actions">
                      @if($tmp->status == "Parkir")
                      <a>
                        <button type="button" class="btn btn-warning" data-id="" data-toggle="tooltips" data-placement="top" title="Edit">
                          Parkir
                        </button>
                      </a>
                      @else
                      <a>
                        <button type="button" class="btn btn-success" data-id="" data-toggle="tooltips" data-placement="top" title="Edit">
                          Selesai
                        </button>
                      </a>
                      @endif
                    </td> --}}
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <br>
            <div class="col-md-10">
                
                <h4 class="card-title">Total Penghasilan : Rp. {{$total}}</h4>
              </div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
    <!-- end row -->
  </div>
</div>

