<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

@vite([
    'resources/js/app.js',
    'resources/js/poll-store.js',
    'resources/css/app.css'
])
<body class>
<x-header></x-header>
<main class="flex flex-col items-center h-8/12 justify-center">
    <h2 class="text-2xl mb-6 font-bold">Login</h2>

    @if ($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form class="flex flex-col gap-1 2xl:gap-2" method="POST" action="/login">
        @csrf

        <input class="border w-80 2xl:w-120 rounded-sm border-gray-300 p-1.5 " type="text" placeholder="Nome" name="name" value="{{ old('name') }}"><br>

        <input class="border w-80 2xl:w-120 rounded-sm border-gray-300 p-1.5" placeholder="Senha" type="password" name="password"><br>

        <button class="mb-2 rounded-xs  w-full bg-cyan-500 hover:bg-sky-700 text-white hover:black cursor-pointer p-1.5" type="submit">Login</button>
        <div>Não tem conta? <a href="/register" class="text-blue-600 font-medium underline">Cadastre-se</a></div>
    </form>
</main>


</body>
</html>
