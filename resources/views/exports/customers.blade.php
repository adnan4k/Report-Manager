<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Customers Report</h2>
    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Business Name</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>TIN</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer['Customer'] }}</td>
                    <td>{{ $customer['Email'] }}</td>
                    <td>{{ $customer['Phone'] }}</td>
                    <td>{{ $customer['Address'] }}</td>
                    <td>{{ $customer['Business Name'] }}</td>
                    <td>{{ $customer['Price'] }}</td>
                    <td>{{ $customer['Payment Status'] }}</td>
                    <td>{{ $customer['TIN'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
