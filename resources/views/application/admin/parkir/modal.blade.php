<div class="modal fade" id="modalUser" role="dialog" style="overflow-y: scroll;">
  <div class="modal-dialog modal-lg margin-top-30" role="document">
    <form  id="formUser" action="" enctype="multipart/form-data" method="POST">
      <input type="hidden" name="_token" value="{{ Session::token() }}" />
      <input type="hidden" name="txtIdROP" id="txtIdROP"/>
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="my-modal-history"><b> Tambah User Baru </b></h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <hr class="divider no-margin-bottom"> -->
          <br>
          <div class="row ">
            <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Nama :</span>
            <div class="col-md-4 col-sm-9 col-9">
              <div class="form-group">
                <input type="hidden" name="hdID" id="hdID">
                <input type="text" class="form-control" name="txtNama" id="txtNama">
              </div>
            </div>
            <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Role :</span>
            <div class="col-md-4 col-sm-9 col-9">
              <div class="form-group" style="margin-top: 4px;">
                <select class="selectpicker" id="txtRole" name="txtRole" data-size="7" data-style="select-with-transition" title="Kategori"  required >
                  <option selected="" disabled="" value="0">Role</option>
                  <option value="1">Admin</option>
                  <option value="2">User</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row ">
            <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Email :</span>
            <div class="col-md-4 col-sm-9 col-9">
              <div class="form-group">
                <input type="email" class="form-control" value="" name="txtEmail" id="txtEmail" >
              </div>
            </div>
            <span class="col-md-2 col-sm-3 col-3 semi-bold col-form-label">Password :</span>
            <div class="col-md-4 col-sm-9 col-9">
              <div class="form-group">
                <input type="text" class="form-control" value="" name="txtPassword" id="txtPassword" >
              </div>
            </div>
          </div>
          <br>
          <!-- <hr class="divider"> -->
          <div class="text-right">
            <button type="submit" id="submit-update" class="btn btn-md btn-success">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>