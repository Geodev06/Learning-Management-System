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
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h4 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 13px;
        }

        table th,
        table {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        td {
            border: 1px solid gainsboro;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Ensure the table headers repeat on new pages when content overflows */
        table thead {
            display: table-header-group;
        }

        table tr {
            page-break-inside: avoid;
            /* Prevent rows from being split across pages */
        }

        /* Remove any forced page breaks */
        .page-break {
            page-break-before: always;
        }

        .lesson-header {
            background-color: #e9e9e9;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <h4>{{ strtoupper($module->title) }}</h4>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>{{ $name }}</th>
                </tr>
                <tr>
                    <th>Organization</th>
                    <th>{{ $course }}</th>
                </tr>
            </thead>
        </table>

        <!-- Loop through lessons without page breaks -->
        @foreach($module_lessons as $key => $val)
        <table>
            <thead>
                <tr class="lesson-header">
                    <th>Lesson # {{ $val['lesson_no'] }}</th>
                    <th>Category</th>
                    <th width="10%">Points</th>
                    <th width="10%">Total Points</th>
                    <th width="10%">Grade</th>
                    <th width="20%">Date</th>

                </tr>
            </thead>
            <tbody>
                @foreach($val['detail'] as $k => $dt)
                <tr>
                    <td></td>
                    <td><span style="font-style: italic;">{{ $k }} </span></td>
                    <td>{{ $dt['total_points'] }}</td>
                    <td>{{ $dt['points'] }}</td>
                    <td>{{ $dt['grade'] }}</td>
                    <td>{{ $dt['date'] }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach

    </div>

    <div class="container" style="padding: 20px;">
        <p style="margin: 0; color : #1F3BB3; font-size: 12px">Learning Management System</p>
        <p style="margin: 0; color : #1F3BB3; font-size: 12px">@lpsu.edu.ph</p>
    </div>

</body>

</html>