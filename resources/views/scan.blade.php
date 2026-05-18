<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
<body>

<video id="video-scanner"></video>
<button id="start-scan-btn" type="button">Start Scan</button>
<button id="stop-scan-btn" type="button">Stop Scan</button>

<form action="{{ route('log') }}" method="POST">
    @csrf
    <ul id="scan-results"></ul>
    <div id="scan-inputs"></div>
    <button type="submit">Submit</button>
</form>
</body>
</html>
