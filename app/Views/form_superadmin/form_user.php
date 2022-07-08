<?php
$dropdown = getDropdownListKey('departemen', 'nama_departemen, id', 'nama_departemen');
$js = 'class="form-control"';
if ($dropdown == null) : ?>
    <script>
        $('.mytambah, .myedit').on('click', function() {
            setTimeout(function() {
                $('#modal-form').modal('hide');
                error('Daftar Departemen Kosong/Tidak Aktif');
            }, 500);
        })
    </script>
<?php endif; ?>
<div class="modal fade" id="modal-form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="nama_user">Nama User</label>
                        <input type="text" class="form-control" id="nama_user" placeholder="Masukan Nama User" name="nama_user">
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukan email" name="email">
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label>Select Departemen</label>
                        <?php
                        echo form_dropdown_key('departemen', $dropdown, 'large', $js, 'Departemen');
                        ?>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" rows="3" name="password"></input>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label>Select</label>
                        <select name="level" class="form-control">
                            <option value="" selected>~Pilih Role~</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="foto">Unduh Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="foto" onchange="imgPreview()">
                            <label class="custom-file-label" for="foto">Pilih Foto</label>
                        </div>
                        <span class="help-block text-danger"></span>
                        <img class="img-preview img-fluid mt-3 mb-3" width="100%" height="250px">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="btn-save" onclick="ajaxSave()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>