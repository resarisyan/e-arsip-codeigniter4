function success(text) {
    $(document).ready(function() {
      toastr.success(text)
    });
}

function error(text) {
    $(document).ready(function() {
        toastr.error(text)
      });
}

function warning(text) {
    $(document).ready(function() {
        toastr.warning(text)
      });
}

const modalConfirm = function(callback){
    $("#mi-modal").modal('show');
    $("#modal-btn-si").on("click", function(){
      callback(true);
      $("#mi-modal").modal('hide');
    });
    
    $("#modal-btn-no").on("click", function(){
      callback(false);
      $("#mi-modal").modal('hide');
    });
  };

function confirmDialog(message, handler){
  $(`<div class="modal fade" id="myModal" role="dialog"> 
     <div class="modal-dialog"> 
       <!-- Modal content--> 
        <div class="modal-content"> 
           <div class="modal-body" style="padding:10px;"> 
             <h4 class="text-center">${message}</h4> 
             <div class="text-center"> 
               <a class="btn btn-danger btn-yes">Ya!</a> 
               <a class="btn btn-default btn-no">Tidak!</a> 
             </div> 
           </div> 
       </div> 
    </div> 
  </div>`).appendTo('body');
 
  //Trigger the modal
  $("#myModal").modal({
     backdrop: 'static',
     keyboard: false
  });
  
   //Pass true to a callback function
   $(".btn-yes").click(function () {
       handler(true);
       $("#myModal").modal("hide");
   });
    
   //Pass false to callback function
   $(".btn-no").click(function () {
       handler(false);
       $("#myModal").modal("hide");
   });

   //Remove the modal once it is closed.
   $("#myModal").on('hidden.bs.modal', function () {
      $("#myModal").remove();
   });
}