@extends('application.include.master')

@section('title','List User')

@section('content')
@include('application.admin.user.modal_user')
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
                <h4 class="card-title">List User</h4>
              </div>
              <div class="col-md-2 col-sm-6 col-6">
                <button type="button" class="btn btn-danger padding-10" data-toggle="modal" data-target="#modalUser" id="btnAddNew" style="float: right;" onclick="AddNew()">
                  <i class="material-icons">create</i>
                  Tambah
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="material-datatables">
              <table id="dataList" class="table table-striped table-no-bordered table-hover dataTables" cellspacing="0" width="100%" style="width:100%">
                <thead class="bold">
                  <tr>
                    <th class="disabled-sorting">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Rolename</th>
                    <th>Created Date</th>
                    <th class="disabled-sorting text-center">Actions</th>
                  </tr>
                </thead>
                <!-- {{$no = 1}} -->
                <tbody>
                  @foreach($data as $tmp)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$tmp->nama}}</td>
                    <td>{{$tmp->email}}</td>
                    <td>{{$tmp->nama_role}}</td>
                    <td>{{$tmp->createdDate}}</td>
                    <td class="td-actions text-center">
                      <form class="formDelete" action="{{route('DeleteUser')}}/{{$tmp->id}}" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <a onclick="Edit(`{{$tmp->id}}`,`{{$tmp->nama}}`,`{{$tmp->id_role}}`,`{{$tmp->email}}`,`{{md5($tmp->password)}}`)">
                          <button type="button" class="btn btn-link btn-warning btnEdit" data-id="" data-toggle="tooltips" data-placement="top" title="Edit">
                            <i class="material-icons">create</i>
                          </button>
                        </a>
                        <a onclick="Delete(`{{$tmp->id}}`)">
                          <button type="button" class="btn btn-link btn-danger delete" data-toggle="tooltips" data-placement="top" title="Hapus">
                            <i class="material-icons">delete_forever</i>
                          </button>
                        </a>
                      </form>
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
  function AddNew(){
    $('#formUser').attr('action','{{route("actionCUUser")}}');
    $('#modalUser').modal('show');
    $('#txtNama').val('');
    $('#txtRole').val('');
    $('#txtEmail').val('');
    $('#txtPassword').val('');
    $('#my-modal-history').text('Tambah User Baru');
  }

  function Edit(id,nama,role,email,password) {
    $('#formUser').attr('action','{{route("actionCUUser")}}/'+id);
    $('#modalUser').modal('show');
    $('#txtNama').val(nama);
    $('#txtRole').val(role);
    $('#txtEmail').val(email);
    $('#txtPassword').val('');
    $('#my-modal-history').text('Edit User ');
  }
  
  function Delete(id) {
    // location.href = "{{route('DeleteUser')}}/"+id;
    swal({
      title: 'Apakah anda yakin?',
      text: "ingin menghapus user ini !",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#ea3729',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((willDelete) => {
      if (willDelete.value) {
        swal({
          title: 'Hapus Berhasil!',
          text: "user telah terhapus!",
          type: 'success',
        }).then((value) => {
          $( ".formDelete" ).submit()
        });
      } else {
        swal(
          'Cancelled',
          'Your file is safe :)',
          'error'
        );
      }
    });
  }
</script>
@endsection