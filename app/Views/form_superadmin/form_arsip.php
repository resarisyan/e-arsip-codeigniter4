<?php
$departemen = getDropdownListKey('departemen', 'nama_departemen, id', 'nama_departemen');
$kategori = getDropdownListKey('kategori', 'nama_kategori, id', 'nama_kategori');
$user = getDropdownListKey('user', 'nama_user, id', 'nama_user');

$js = 'class="form-control"';
if ($departemen == null || $kategori == null || $user == null) : ?>
    <script>
        $('.mytambah, .myedit').on('click', function() {
            setTimeout(function() {
                $('#modal-form').modal('hide');
                error('Terdapat Daftar Departemen/Kategori/User Yang Kosong/Tidak Aktif');
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
                        <label for="no_arsip">No Arsip</label>
                        <input type="text" class="form-control" id="no_arsip" placeholder="Masukan No Arsip" name="no_arsip">
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="nama_arsip">Nama Arsip</label>
                        <input type="nama_arsip" class="form-control" id="nama_arsip" placeholder="Masukan Nama Arsip" name="nama_arsip">
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label>Select Kategori</label>
                        <?=
                        form_dropdown_key('kategori', $kategori, 'large', $js, 'Kategori');
                        ?>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label>Select User</label>
                        <?=
                        form_dropdown_key('user', $user, 'large', $js, 'User');
                        ?>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label>Select Departemen</label>
                        <?=
                        form_dropdown_key('departemen', $departemen, 'large', $js, 'Departemen');
                        ?>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Arsip</label>
                        <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"></textarea>
                        <span class="help-block text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="file_arsip">Upload Arsip</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file_arsip" name="file_arsip">
                            <label class="custom-file-label" for="file_arsip">Pilih File Arsip</label>
                        </div>
                        <span class="help-block text-danger"></span>
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