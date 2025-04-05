<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 

    <!-- Simple CSS for Table Design -->
    <style>
        

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

        th, td {
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
        <h4>Report on Student Modality per Organization</h4>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Organization</th>
                    <th>Learning Modality</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $dt)
                    <tr>
                        <td>
                            {{ $dt->name }}
                        </td>
                        <td>
                            {{ $dt->gender }}
                        </td>
                        <td>
                            {{ $dt->org }}
                        </td>
                        <td>
                            {{ $dt->modality }}
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="4">No Data</td>
                </tr>
                @endforelse
            </tbody>
            
        </table>
    </div>

</body>

</html>
