let table;
let save_method;
let url;

$(document).ready(function(){
    table = $('#mytable').DataTable({
        "responsive": true,
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
    $('#nama_kategori').removeClass('is-invalid');
    $('.help-block').empty();
    $('#modal-form').modal('show');
    $('.modal-title').text('Tambah Kategori');
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
                // $('#nama_kategori').addClass('is-invalid')
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