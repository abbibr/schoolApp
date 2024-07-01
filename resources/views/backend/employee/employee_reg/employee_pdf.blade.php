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

    <h1>Details of employee: {{ $employee_user->name }}</h1>

    <table id="customers">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Fee Data</th>
                <th>Employee Fee Details</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>Employee Name</td>
                <td>{{ $employee_user->name }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Employee ID</td>
                <td>{{ $employee_user->id_no }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Employee Phone</td>
                <td>{{ $employee_user->mobile }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Employee Date of Birth</td>
                <td>{{ $employee_user->dob }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Employee Email</td>
                <td>{{ $employee_user->email }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Employee Address</td>
                <td>{{ $employee_user->address }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Employee Joining Date</td>
                <td>{{ $employee_user->join_date }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Employee Previous Salary</td>
                <td>{{ $employee_user->employee_salary[0]->previous_salary }} sum</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Employee Present Salary</td>
                <td>{{ $employee_user->employee_salary[0]->present_salary }} sum</td>
            </tr>
        </tbody>
    </table> <br>

    <p>Printed date: {{ date('d-m-Y') }}</p>

</body>

</html>
