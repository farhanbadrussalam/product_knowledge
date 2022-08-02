<!-- Modal tambah -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambah">Tambah kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="{{ url('dashboard/kategori') }}">
        @csrf
        <div class="modal-body">
          <div class="col-md-12">
              <label for="name_kategori">Kategori</label>
              <input type="text" name="name" id="name_kategori" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="simpandata">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEdit">Edit kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="#" id="formUpdate">
        @method('put')
        @csrf
        <div class="modal-body">
          <div class="col-md-12">
              <label for="update_name">Kategori</label>
              <input type="text" name="name" id="update_name" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="simpandata">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>