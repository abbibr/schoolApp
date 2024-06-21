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

    <h2>{{ $exam }} Details of student: {{ $assign_student->student->name }}</h2>

    <table id="customers">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Exam Fee Data</th>
                <th>Student Exam Fee Details</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>Student Name</td>
                <td>{{ $assign_student->student->name }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Student ID</td>
                <td>{{ $assign_student->student->id_no }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Student Role</td>
                <td>{{ $assign_student->roll }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Student Date of Birth</td>
                <td>{{ $assign_student->student->dob }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Student Father Name</td>
                <td>{{ $assign_student->student->fname }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Student Mother Name</td>
                <td>{{ $assign_student->student->mname }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Exam Fee (sum)</td>
                <td>{{ $fee_category_amount->amount }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Discount</td>
                <td>{{ $assign_student->discount[0]->discount }}%</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Student {{ $exam }} Fee (sum)</td>
                <td>{{ $final_fee }}</td>
            </tr>
        </tbody>
    </table> <br>

    <p>Printed date: {{ date('d-m-Y') }}</p>

</body>

</html>
