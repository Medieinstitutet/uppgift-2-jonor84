<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>500</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset('starwars.jpg') }}');
            background-size: cover;
            background-position: center;
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    <meta name="robots" content="noindex, follow">
</head>

<body class="bg-gray-900 text-white">
    <div id="notfound" class="flex justify-center items-center h-screen">
        <div class="notfound text-center">
            <div class="notfound-404 mb-6">
                <h1 class="text-9xl font-bold mb-4"><span>5</span><span>0</span><span>0</span></h1>
            </div>
            <h2 class="text-2xl font-semibold mb-8">You underestimate the power<br> of the dark side.</h2>
            <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md transition duration-300 ease-in-out inline-block">
                USE THE FORCE <i class="bi bi-magic"></i>
            </a>
        </div>
    </div>
</body>

</html>
