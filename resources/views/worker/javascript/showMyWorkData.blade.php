<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // DataTable
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('data.my_work')}}",
            "lengthMenu": [ 10, 20, 30, 50 ],
            columns: [

                { data:'id', name: 'id', render: function (data, type, row, meta) 
                    {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                { data: 'company_website', name: 'company_website'},
                { data: 'company_email', name: 'company_email'},
                { data: 'country', name: 'country'},
                { data: 'screenshot', name: 'screenshot'},
                { data: 'remark', name: 'remark'},
                { data: 'name', name: 'name'},
                { data: 'number', name: 'number'},
                { data: 'link', name: 'link'},
                { data: 'text', name: 'text'},
                { data: 'job_status.status', name: 'JobStatus.status'},

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