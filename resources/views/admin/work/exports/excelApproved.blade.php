<table class="table table-bordered display" width="100%" cellspacing="0">
    <thead>
        <tr>
                <th>No</th>
                <th>Website</th>
                <th>Email</th>
                <th>Country</th>
                <th>Remark</th>
                <th>Name</th>
                <th>Number</th>
                <th>Link</th>
                <th>Text</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item['company_website'] ?? "" }}</td>
            <td>{{ $item['company_email'] ?? "" }}</td>
            <td>{{ $item['country']['country_name'] ?? "" }}</td>
            <td>{{ $item['remark'] ?? "" }}</td>
            <td>{{ $item['name'] ?? "" }}</td>
            <td>{{ $item['number'] ?? "" }}</td>
            <td>{{ $item['link'] ?? "" }}</td>
            <td>{{ $item['text'] ?? "" }}</td>
        </tr>
    @endforeach
    </tbody>
</table>