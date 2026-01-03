<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enquetes</title>
</head>

@vite([
    'resources/js/app.js',
    'resources/js/poll-store.js',
    'resources/css/app.css'
])

<body>
    <x-header></x-header>
    <main class="flex-col flex items-center lg:mt-10 2xl:mt-15 mb-20">
        <h1 class="text-2xl font-bold">Criar uma nova enquete</h1>
        <form class="mt-6" method="POST" action="/polls">
            @csrf
            <section id="inputs-container" class="flex flex-col gap-2 text-1xl 2xl:min-w-150"  >
                <h2>Informações gerais:</h2>
                <div class="flex flex-col gap-2 mb-3">
                    <div  class="input-group">
                        <input class="border w-full rounded-sm border-gray-300 p-1.5" type="text" name="title" placeholder="Titulo" value="{{old("title")}}">
                    </div>

                    <div class="input-group">
                        <input class="border w-full rounded-sm border-gray-300   p-1.5" type="number" name="time_limit" placeholder="Tempo limite(horas)" value={{old("time_limit")}}>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="requireLogin">Requer Login para Votar?</label>
                    <input id="requireLogin" name="require_login" type="checkbox" {{old("require_login") ? "checked" : ""}}>
                </div>

                <h2>Adicionar alternativas:</h2>
                <div id="alternatives-container" class="flex flex-col gap-2 mb-3">
                    <div class="input-group">
                        <input class="border rounded-sm border-gray-300   p-1.5" name="alternatives[]" placeholder="Alternativa">
                    </div>
                    <div class="input-group">
                        <input class="border rounded-sm border-gray-300   p-1.5" type="text" name="alternatives[]" placeholder="Alternativa">
                    </div>

                </div>
            </section>
            <section class="grid grid-rows-1 gap-3">
                <button class="rounded-xs bg-cyan-500 hover:bg-sky-700 text-white hover:black cursor-pointer p-1.5" type="button" id="add-input">Adicionar Nova Alternativa</button>
                <button class="rounded-xs bg-cyan-500 hover:bg-sky-700 text-white hover:black cursor-pointer p-1.5" type="submit">Criar Enquete</button>
            </section>
        </form>
        <div class="flex flex-col justify-items-start">
            <div class="text-red-600 font-medium mt-2" id="error-message"></div>

            @if($errors->any())
                <div class="text-red-600 font-medium mt-2" id="error-message">{{$errors->first()}}</div>
            @endif
        </div>
    </main>
</body>
</html>
