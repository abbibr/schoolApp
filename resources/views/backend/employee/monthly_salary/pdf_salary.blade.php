<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h1>Employee Monthly Salary: {{ $details[0]->employee->name }}</h1>

    <table id="customers">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Details</th>
                <th>Employee Data</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>Employee Name</td>
                <td>{{ $details[0]->employee->name }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Basic Salary</td>
                <td>{{ number_format($salary) }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Total Absent For This Month</td>
                <td>{{ $absentCount }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Month</td>
                <td>{{ date('M Y', strtotime($date)) }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Salary This Month</td>
                <td>{{ number_format($totalSalary) }}</td>
            </tr>
        </tbody>
    </table> <br>

    <p>Printed date: {{ date('d-m-Y') }}</p>

</body>

</html>
