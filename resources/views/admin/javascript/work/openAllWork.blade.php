<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/admin/js/ajax/work/approveWork.js') }}"></script>
<script src="{{ asset('assets/admin/js/ajax/work/disapproveWork.js') }}"></script>
<script src="{{ asset('assets/admin/js/ajax/work/selectAllCheckbox.js') }}"></script>
<script>
$(document).ready(function(){
    $("#openAll").click(function(){
        var res = []
        var data = $("table input:checkbox:checked")
        
        data.map(function(){
            var id = parseInt(this.value)
            res.push(id)
        })

        @foreach($job as $jobs)
        var id = "{{ $jobs['id'] }}"

        if(jQuery.inArray( parseInt(id), res) !== -1){
            var windowPopup = window.open("{{ route('admin.work.edit', $jobs['id']) }}", '_blank');
        }
        @endforeach 
    })

    $("#openAllWebsite").click(function(){
        var res = []
        var data = $("table input:checkbox:checked")
        
        data.map(function(){
            var id = parseInt(this.value)
            res.push(id)
        })

        @foreach($job as $jobs)
        var id = "{{ $jobs['id'] }}"

        if(jQuery.inArray( parseInt(id), res) !== -1){
            var windowPopup = window.open("{{ $jobs['company_website'] }}", '_blank');
        }
        @endforeach 
    })

    $("#openAllScreenshot").click(function(){
        var res = []
        var data = $("table input:checkbox:checked")
        
        data.map(function(){
            var id = parseInt(this.value)
            res.push(id)
        })

        @foreach($job as $jobs)
        var id = "{{ $jobs['id'] }}"

        if(jQuery.inArray( parseInt(id), res) !== -1){
            var windowPopup = window.open("{{asset($jobs['screenshot_url'])}}", '_blank');
        }
        @endforeach 
    })
})
</script>