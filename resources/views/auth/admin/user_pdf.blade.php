<!DOCTYPE html>
<html>

<head>
    <title>User List</title>
    <style>
        /* Fonts and colors */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            /* padding: 20px; */
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-weight: 500;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px 5px;
            text-align: left;
        }

        /* Table headers */
        th {
            background-color: #34495e;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Table rows */
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Specific column styling */
        td:nth-child(1),
        td:nth-child(2) {
            font-weight: bold;
        }

        td {
            font-size: 12px;
        }

        /* Footer styling */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>

    <table style="table-layout: fixed; width: 100%;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Division</th>
                <th>Zilla</th>
                <th>Upzilla</th>
                <th>Address</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ Str::limit($user->name, 20) }}</td>
                    <td style="width: 150px; word-wrap: break-word; white-space: normal;">{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    @if ($user->role_id == 4)
                        <td>
                            {{ $user->retailer?->division }}
                        </td>
                        <td>
                            {{ $user->retailer?->zilla }}
                        </td>
                        <td>
                            {{ $user->retailer?->upzilla }}
                        </td>
                        <td style="width: 150px;">
                            {{ $user->retailer?->address ? $user->retailer->address . ',' : '' }}
                            {{ $user->retailer?->post_code ?? '' }}
                        </td>
                        
                    @elseif ($user->role_id == 3)
                        <td>
                            {{ $user->shop?->division }}
                        </td>
                        <td>
                            {{ $user->shop?->district }}
                        </td>
                        <td>
                            {{ $user->shop?->city }}
                        </td>
                        <td>

                            {{ $user->shop?->address ? $user->shop->address . ',' : '' }}
                            {{ $user->shop?->post_code ?? '' }}
                        </td>
                    @else
                        <td>Not found</td>
                        <td>Not found</td>
                        <td>Not found</td>
                        <td>Not found</td>
                    @endif

                    <td>{{ $user->role->display_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->toFormattedDateString() }} by Your UKRB
    </div>
</body>

</html>
