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
                { data: 'screenshot_url', name: 'screenshot_url'},
                { data: 'remark', name: 'remark'},
                { data: 'country.country_name', name: 'Country.country_name'},
                { data: 'jobs_status.status', name: 'JobsStatus.status'},

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