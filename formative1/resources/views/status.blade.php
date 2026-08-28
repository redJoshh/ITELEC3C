<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Status</title>
</head>

<body>
    @if ($status == 'active')
        <h1>Student is currently enrolled.</h1>
    @elseif ($status == 'inactive')
        <h1>Student is currently inactive.</h1>
    @elseif ($status == 'graduated')
        <h1>Student has already graduated.</h1>
    @else
        <h1>Student status is unknown.</h1>
    @endif
</body>

</html>
