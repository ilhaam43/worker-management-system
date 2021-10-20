function rejectConfirmation() {
    swal({
        title: "Reject researches data",
        text: "Are you sure to reject this data?",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Reject",
        cancelButtonText: "Cancel",
        reverseButtons: !0
    }).then(function (e) {
        if (e.value === true) {
            var id = [];
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $(':checkbox:checked').each(function(i){
                id[i] = $(this).val();
            });

            if(id.length === 0) {
                swal("Error!", "please select atleast one checkbox", "error");
            }else{
            $.ajax({
                type: 'POST',
                url: "/admin/work/disapprove",
                cache: false,
                data: {_token: CSRF_TOKEN, id:id},
                dataType: 'JSON',
                success: function (results) {
                    if (results.success === true) {
                        for(var i=0; i<id.length; i++){
                            swal("Done!", results.message, "success");
                            $('tr#'+id[i]+'').css('background-color', '#ccc');
                            $('tr#'+id[i]+'').remove();
                        }
                    } else {
                        swal("Error!", results.message, "error");
                    }
                }
            });
        }
    } else {
        e.dismiss;
    }

    }, function (dismiss) {
        return false;
    })
}
