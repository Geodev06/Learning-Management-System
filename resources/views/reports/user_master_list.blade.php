<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <!-- Simple CSS for Table Design -->
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h4 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <div class="container">
        <h4>Users MasterList</h4>
        <p style="margin: 0; font-size: 12px">ADMIN : {{ $admin }}</p>
        <p style="margin: 0; font-size: 12px">STUDENT : {{ $teacher }}</p>
        <p style="margin: 0; font-size: 12px">TEACHER : {{ $student }}</p>

        <table style="font-size: 13px;">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Org Code</th>
                    <th>Learning Modality</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Last Login</th>
                    <th>Role</th>


                </tr>
            </thead>
            <tbody>
                @forelse($data as $dt)
                <tr>
                    <td>{{ $dt->email }}</td>
                    <td>{{ base64_decode($dt->first_name) }}</td>
                    <td>{{ base64_decode($dt->middle_name) }}</td>
                    <td>{{ base64_decode($dt->last_name) }}</td>
                    <td>{{ $dt->org_code }}</td>
                    <td>{{ $dt->learning_modality }}</td>
                    <td>{{ $dt->active_flag == 'Y' ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $dt->created_at }}</td>
                    <td>{{ $dt->updated_at }}</td>
                    <td>{{ $dt->role }}</td>

                </tr>
                @empty
                <tr>
                    <td colspan="10">No Data</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="9" style="text-align: right;"><b>Count</b></td>
                    <td ><b>{{ sizeof($data) }}</b></td>
                </tr>
            </tbody>

        </table>
    </div>

</body>

</html>