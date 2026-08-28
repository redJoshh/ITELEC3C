<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Announcements</title>
</head>

<body>
    @forelse ($announcements as $announcement)
        <h2>{{ $announcement['title'] }}</h2>
        <p>{{ $announcement['content'] }}</p>
    @empty
        <h1>No announcements available.</h1>
    @endforelse
</body>

</html>
