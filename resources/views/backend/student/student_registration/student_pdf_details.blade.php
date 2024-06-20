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

    <div id="student">
        <h2>Details of student: {{ $assign_student->student->name }}</h2>
        <img src="storage/{{ $assign_student->student->image }}" style="border-radius: 100%;" width="135px" height="135px">
    </div> <br>

    <table id="customers">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Data</th>
                <th>Student Details</th>
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
                <td>Student Father Name</td>
                <td>{{ $assign_student->student->fname }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Student Mother Name</td>
                <td>{{ $assign_student->student->mname }}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Student Mobile</td>
                <td>{{ $assign_student->student->mobile }}</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Student Address</td>
                <td>{{ $assign_student->student->address }}</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Student Gender</td>
                <td>{{ $assign_student->student->gender }}</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Student Religion</td>
                <td>{{ $assign_student->student->religion }}</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Student Date of Birth</td>
                <td>{{ $assign_student->student->dob }}</td>
            </tr>
            <tr>
                <td>9</td>
                <td>Discount</td>
                <td>{{ $assign_student->discount[0]->discount }}%</td>
            </tr>
            <tr>
                <td>10</td>
                <td>Year</td>
                <td>{{ $assign_student->year->name }}</td>
            </tr>
            <tr>
                <td>11</td>
                <td>Class</td>
                <td>{{ $assign_student->class->name }}</td>
            </tr>
            <tr>
                <td>12</td>
                <td>Group</td>
                <td>{{ $assign_student->group->name }}</td>
            </tr>
            <tr>
                <td>13</td>
                <td>Shift</td>
                <td>{{ $assign_student->shift->name }}</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Student ID</td>
                <td>{{ $assign_student->student->id_no }}</td>
            </tr>
            <tr>
                <td>15</td>
                <td>Student Role</td>
                <td>{{ $assign_student->roll }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
