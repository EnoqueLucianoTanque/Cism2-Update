
/* Active or Inactive Status*/
const lg = sessionStorage.getItem("language");
function status_change(model,model_id,name,statuslabel,status)
{
	swal({
        title: "",
        text: "Are you sure you want to "+statuslabel+" "+name+" ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {

            $.ajax({
                type:'POST',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:  urlPostData,
                data: {
                    model: model,model_id: model_id,status: status
                },
                success: function (data) {
                    $('.datatable').DataTable().ajax.reload( null, false )
                }
            });
            swal(model+" status changed successfully.", { icon: "success",});
        }
    });
}

/* Delete Master's data*/
function delete_data(name,form_id,display_name){
    swal({
        title: "",
        text: "Deseja remover o(a) "+name+" ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            swal(display_name+" foi removido com sucesso.", {
                icon: "success",
            });
            document.getElementById(form_id).submit(); return false;
        }
    });
}
function update_data(name,form_id,display_name){
    var msg = '';
    if(lg == 'en'){
        msg = "You want to update the ";
    }else{
        msg = "Deseja actualizar o(a) "
    }
    var msg2 = '';
    if(lg == 'en'){
        msg2 = "has been successfully added ";
    }else{
        msg2 = "foi adicionado(da) com sucesso."
    }
    swal({
        title: "",
        text: msg+" "+name+" ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal(display_name+" "+msg2, {
                    icon: "success",
                });
                document.getElementById(form_id).submit(); return false;
            }
        });
}
function update_data_study(name,form_id,display_name){
    swal({
        title: "",
        text: "Deseja concluir a fase de estudo?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                swal("A fase de estudo foi concluida com sucesso.", {
                    icon: "success",
                });
                document.getElementById(form_id).submit(); return false;
            }
        });
}

// Remove message after 4 second

if ($('div').hasClass('alert-success')) {
    setTimeout(function() {
                $('.alert-success').fadeOut(1000);
            }, 4000 );
}


