<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grade Result</title>
</head>

<body>

    <table>
        <tr>
            <th>Grade</th>
            <th>Result</th>
        </tr>
        <tr>
            <td>90-100</td>
            <td>Excellent</td>
        </tr>
        <tr>
            <td>80-89</td>
            <td>Very Good</td>
        </tr>
        <tr>
            <td>75-79</td>
            <td>Passed</td>
        </tr>
        <tr>
            <td>Below 75</td>
            <td>Failed</td>
        </tr>
    </table>

    <h2>Grade: {{ $grade }}</h2>
    @if ($grade >= 90 && $grade <= 100)
        <h2>Result: Excellent</h2>
    @elseif ($grade >= 80 && $grade <= 89)
        <h2>Result: Very Good</h2>
    @elseif ($grade >= 75 && $grade <= 79)
        <h2>Result: Passed</h2>
    @elseif ($grade < 75)
        <h2>Result: Failed</h2>
    @else
        <h2>Result: Invalid Grade</h2>
    @endif
</body>

</html>
