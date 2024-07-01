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

    <table id="customers">
        <thead>
            <tr>
                <th>
                    <b>#</b>
                </th>
                <th>
                    <b>Employee ID</b>
                </th>
                <th>
                    <b>Employee Name</b>
                </th>
                <th>
                    <b>Employee Phone</b>
                </th>
                <th>
                    <b>Employee Date of Birth</b>
                </th>
                <th>
                    <b>Employee Address</b>
                </th>
                <th>
                    <b>Employee Joining date</b>
                </th>
                <th>
                    <b>Employee Present Salary</b>
                </th>
                <th>
                    <b>Employee Designation</b>
                </th>
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
                        {{ date('d/m/Y', strtotime($employee->join_date ))}}
                    </td>
                    <td>{{ $employee->employee_salary[0]->present_salary }}</td>
                    <td>{{ $employee->designation->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
