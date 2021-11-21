<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // DataTable
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('data.work.disapproved')}}",
            "lengthMenu": [ 10, 20, 30, 50 ],
            columns: [
                { data: 'checkbox', 
                    name: 'checkbox', 
                    orderable: false, 
                    searchable: false 
                },

                { data:'id', name: 'id', render: function (data, type, row, meta) 
                    {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                { data: 'company_website', name: 'company_website'},
                { data: 'company_email', name: 'company_email'},
                { data: 'country', name: 'country'},
                { data: 'remark', name: 'remark'},
                { data: 'user.name', name: 'User.name'},
                { data: 'screenshot', name: 'screenshot'},
                { data: 'name', name: 'name'},
                { data: 'number', name: 'number'},
                { data: 'link', name: 'link'},
                { data: 'text', name: 'text'},
                
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });

    });
</script>