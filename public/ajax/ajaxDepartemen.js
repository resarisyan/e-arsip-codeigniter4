let table;
let save_method;
let url;

$(document).ready(function(){
    table = $('#mytable').DataTable({
        "pageLength": 10,
        "autoWidth": true,
        "lengthChange": false,
        "ordering": false,
        "processing": true,
        "searching": true,
        "serverSide":true,
        "deferRender":true,
        "ajax": {
            'url': urlList,
            "type": "GET"
        }
    });
});

function reload_table(){
    table.ajax.reload(null, false);
}

function show(){
    save_method = 'save';

    $('#modal-form form')[0].reset();
    $('#nama_departemen').removeClass('is-invalid');
    $('.help-block').empty();
    $('#modal-form').modal('show');
    $('.modal-title').text('Tambah Departemen');
}

function ajaxSave(){
    $('#btn-save').text('Proses...');
    $('#btn-save').text('Disabled...', true);

    if(save_method == 'save'){
        url = urlSave;
    } else {
        url = urlUpdate;
    }

    $.ajax({
        url: url,
        type: "POST",
        data: new FormData($('#form')[0]),
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data){
            if(data.status){
                $('#modal-form').modal('hide');
                if(url == save_method){
                    success('Data Berhasil Disimpan...');
                } else{
                    success('Data Berhasil Diubah...');
                }
                reload_table();
            } else{
                for(let i=0; i< data.inputerror.length; i++){
                    $(`[name="${data.inputerror[i]}"]`).addClass('is-invalid');
                    $(`[name="${data.inputerror[i]}"]`).next().text(data.error_string[i]);
                }
                // $('.help-block').text(data.error_string);
                // $('#nama_departemen').addClass('is-invalid')
            }
            $('#btn-save').text('Simpan');
            $('#btn-save').attr('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown){
            error(errorThrown);
            $('#btn-save').text('Simpan');
            $('#btn-save').attr('disabled', false);
        }
    })
}

function ajaxEdit(id){
    save_method = 'edit';
    $('#modal-form form')[0].reset();
    $('#nama_departemen').removeClass('is-invalid');
    $('.help-block').empty();

    $.ajax({
        url: urlEdit + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="id"]').val(data.id);
            $('[name="nama_departemen"]').val(data.nama_departemen);
            
            $('#modal-form').modal('show');
            $('.modal-title').text('Ubah Departemen');
        },
        error: function(jqXHR, textStatus, errorThrown){
            error(errorThrown);
        }
    })
}

function ajaxDelete(id){
    confirmDialog("Apakah Anda Yakin Ingin Menghapus Departemen Ini?", (e) => {
        if (e) {
            $.ajax({
                url: urlDelete + id,
                type: "DELETE",
                dataType: "JSON",
                success: function(data){
                    if(data.status){
                        success('Departemen Berhasil Dihapus...');
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    error(errorThrown);
                }
            })
        }
    });
}

function ajaxStatus(id){
    confirmDialog("Apakah Status Ini Akan Diubah?", (e) => {
        if (e) {
            $.ajax({
                url: urlStatus + id,
                type: "PUT",
                dataType: "JSON",
                success: function(data){
                    if(data.status){
                        success('Status Berhasil Diubah...');
                        reload_table();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    error(errorThrown);
                }
            })
        }
    });
}

