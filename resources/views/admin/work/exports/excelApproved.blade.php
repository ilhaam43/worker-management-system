<table class="table table-bordered display" width="100%" cellspacing="0">
    <thead>
        <tr>
                <th>No</th>
                <th>Website</th>
                <th>Email</th>
                <th>Country</th>
                <th>Remark</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item['company_website'] ?? "NULL" }}</td>
            <td>{{ $item['company_email'] ?? "NULL" }}</td>
            <td>{{ $item['country']['country_name'] ?? "NULL" }}</td>
            <td>{{ $item['remark'] ?? "NULL" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>