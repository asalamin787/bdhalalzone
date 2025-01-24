<!DOCTYPE html>
<html>

<head>
    <title>New Shop Pathao Account Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        h1 {
            color: #4CAF50;
        }

        p {
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            max-width: 800px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>New Shop Pathao Account Request</h1>
        <p>Dear Admin,</p>
        <p>A new shop has been created, and the following Pathao account information needs to be set up:</p>

        <table>
            <tr>
                <th>Contact Name</th>
                <td>{{ $datas['contact_name'] }}</td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td>{{ $datas['contact_number'] }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $datas['address'] }}</td>
            </tr>
            <tr>
                <th>Secondary Contact Number</th>
                <td>{{ $datas['secondary_contact_number'] }}</td>
            </tr>
            <tr>
                <th>City</th>
                <td>{{ $datas['city'] }}</td>
            </tr>
            <tr>
                <th>Zone</th>
                <td>{{ $datas['zone'] }}</td>
            </tr>
            <tr>
                <th>Area</th>
                <td>{{ $datas['area'] }}</td>
            </tr>
        </table>

        <p>Please create the Pathao account for this shop at your earliest convenience.</p>

        <p class="footer">Thank you.</p>
    </div>
</body>

</html>
