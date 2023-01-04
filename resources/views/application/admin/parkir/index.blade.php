@extends('application.include.master')

@section('title','Data Parkir')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-danger card-header-icon">
            <div class="row">
              <div class="col-md-10">
                <div class="card-icon">
                  <i class="material-icons">assignment</i>
                </div>
                <h4 class="card-title">Data Parkir</h4>
              </div>
              <!-- <div class="col-md-2 col-sm-6 col-6">
                <button type="button" class="btn btn-danger padding-10" data-toggle="modal" data-target="#modalUser" id="btnAddNew" style="float: right;" onclick="AddNew()">
                  <i class="material-icons">create</i>
                  Tambah
                </button>
              </div> -->
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-1 col-sm-2 col-2" style="/*max-width: 6%;*/">
                <div class="form-group">
                  <input class="form-control" value="Periode : " readonly style="background: #0000; padding-top: 22px;"/>
                </div>
              </div>
              <div class="col-md-2 col-sm-3 col-3" style="     margin-top: 5px;/*max-width: 15%;*/">
                <div class="form-group">
                  <input type="text" class="form-control datepicker" id="dtFrom1" name="dtFrom1" value="{{$dtfrom}}">
                </div>
              </div>
              <div class="col-md-2 col-sm-3 col-3" style="    margin-top: 5px; /*max-width: 15%;*/">
                <div class="form-group">
                  <input type="text" class="form-control datepicker"  id="dtTo1" name="dtTo1" value="{{$dtto}}">
                </div>
              </div>
              <div class="col-md-2 col-sm-9 col-9">
                <div class="form-group" style="margin-top: 10px;">
                  <select class="selectpicker" id="txtRole" name="txtRole" data-size="7" data-style="select-with-transition" title="Kategori"  required >
                    <option selected="" disabled="" value="0">User</option>
                    @foreach($dataUser as $tmp)
                    <option value="{{$tmp->id}}">{{$tmp->nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 col-sm-3 col-3">
                <button type="button" class="btn btn-info" style="margin-top: 10px;float: left;padding:8px 10px;" onclick="setDate(`view`)">
                  Set Tanggal
                </button>
                @if($dtfrom != null)
                <a href="{{route('viewDataParkir')}}">
                  <button type="button" class="btn btn-danger" style="margin-top: 10px;float: left;padding:8px 10px;" >
                    Reset
                  </button>
                </a>
                @endif
                <button type="button" class="btn btn-success" style="margin-top: 10px;float: left;padding:8px 10px;" onclick="setDate(`print`)">
                  Print
                </button>
              </div>
            </div>
            <div class="material-datatables">
              <table id="dataList" class="table table-striped table-no-bordered table-hover dataTables" cellspacing="0" width="100%" style="width:100%">
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
                    <td class="td-actions">
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
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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
@endsection
@section('additionalCSS')
<style type="text/css">
  .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
  .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
  .autocomplete-selected { background: #F0F0F0; }
  .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
</style>
@endsection
@section('additionalJS')
<script type="text/javascript">  

  $('.datepicker#dtFrom1').datetimepicker({
    format: 'YYYY-MM-DD',
    maxDate: 'now',
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
    }
  });

  $('.datepicker#dtTo1').datetimepicker({
    format: 'YYYY-MM-DD',
    maxDate: 'now',
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
    }
  });

  function setDate(type) {
    var from = $('#dtFrom1').val();
    var to = $('#dtTo1').val();
    var role = $('#txtRole').val();
    if(type == "view") {
      location.href = "{{ route('viewDataParkirDateRange') }}?dtFrom="+from+"&dtTo="+to+"&role="+role+""
    } else if(type == "print") {
      location.href = "{{ route('getDataParkir') }}?dtFrom="+from+"&dtTo="+to+"&role="+role+""
    }
    // $.ajax({
    //   url : "{{ route('viewDataParkirDateRange') }}",
    //   type : "GET",
    //   data : { dtFrom : from, dtTo : to},
    //   success : function(data){
    //     console.log(data);
    //   },error : function (data) {
    //     console.log(data);
    //   }
    // });
  }
</script>
@endsection