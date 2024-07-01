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

    <h1>Details of all employees:</h1>

    <table id="customers">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Employee Phone</th>
                <th>Employee Date of Birth</th>
                <th>Employee Address</th>
                <th>Employee Joining date</th>
                <th>Employee Present Salary </th>
                <th>Employee Designation</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($employees as $key => $employee)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $employee->id_no }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->mobile }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>
                        {{ $employee->join_date }}
                    </td>
                    <td>{{ $employee->employee_salary[0]->present_salary }}</td>
                    <td>{{ $employee->designation->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> <br>

    <p>Printed date: {{ now()->format('d/M/Y') }}</p>

</body>

</html>
