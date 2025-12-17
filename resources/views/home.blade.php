<html>
<head>
    <title>Enquetes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
@vite([
   'resources/js/app.js',
   'resources/css/app.css'
])

<body>

<x-header></x-header>
<main class="mr-10 ml-10 mb-13 flex flex-col justify-between">
    <div class="flex flex-col sm:flex-row justify-center  lg:gap-10 2xl:gap-40 items-center">
        <div class="flex flex-col sm:w-100 2xl:w-150">
            <h1 class="text-3xl mb-3 font-extrabold">Crie suas Enquetes</h1>
            <h2 class="text-2xl  font-medium mb-2">Enquetes com votação em tempo real. Sem cadastro necessário!</h2>
            <h3 class="mb-4">Faça sua enquete de maneira simples e rápida aqui:</h3>
            <a class="max-w-31 font-bold rounded-xs bg-cyan-500 hover:bg-sky-700 text-white hover:black cursor-pointer p-2" href="/polls/create">Criar enquete</a>
        </div>

        <div>
            <img alt="Screen with www and people around it" class="2xl:w-170 lg:w-125" src="{{URL::asset('/images/homepage-design.jpg')}}">
            <a href="http://www.freepik.com">Designed by vectorjuice / Freepik</a>
        </div>
    </div>
</main>

</body>

</html>
