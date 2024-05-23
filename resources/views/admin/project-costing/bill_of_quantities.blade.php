<!DOCTYPE html>
<html>
<head>
    <title>Bill of Quantities</title>
</head>
<body>
    <h2>ESTIMATED BILL OF QUANTITIES</h2>
    <h3>Project Name: {{ $projectName }}</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tableData as $row)
            <tr>
                @foreach($row as $column)
                <td>{{ $column }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
