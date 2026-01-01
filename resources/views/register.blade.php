<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
</head>

@vite([
    'resources/js/app.js',
    'resources/js/poll-store.js',
    'resources/css/app.css'
])
<body class>
<x-header></x-header>
<main class="flex flex-col items-center h-8/12 justify-center">
    <h2 class="text-2xl mb-6 font-bold">Registro</h2>


    <form class="flex flex-col gap-1 2xl:gap-2" method="POST" action="/users/register">
        @csrf

        <input class="border w-80 2xl:w-120 rounded-sm border-gray-300 p-1.5 " type="text" placeholder="Nome" name="name" value="{{ old('name') }}"><br>
        <input class="border w-80 2xl:w-120 rounded-sm border-gray-300 p-1.5" placeholder="Email" type="email" name="email"><br>
        <input class="border w-80 2xl:w-120 rounded-sm border-gray-300 p-1.5" placeholder="Senha" type="password" name="password"><br>

        <button class="mb-2 rounded-xs  w-full bg-cyan-500 hover:bg-sky-700 text-white hover:black cursor-pointer p-1.5" type="submit">Registrar</button>
        @if($errors->any())
            <div style="color:red;">
                {{ $errors->first() }}
            </div>
        @endif
        <div>Já tem uma conta? <a href="/login" class="text-blue-600 font-medium underline">Login</a></div>
    </form>
</main>


</body>
</html>
