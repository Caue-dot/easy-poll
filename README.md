# Easy Poll
> Enquetes de forma ágil e eficiente

Easy Poll é uma aplicação web para criar enquetes com votação em tempo real, 
sem necessidade de cadastro. 
Descubra a opinião do público de forma rápida e interativa.

Demo: https://easy-poll.live/


## Requisitos

- Composer
- PHP >=8.2
- Node
- NPM

## Instalação

Clone o repositorio:
```sh
git clone https://github.com/Caue-dot/easy-poll.git
```
Abra a pasta do projeto:
```sh
cd easy-poll
```
Baixe as dependências do projeto:
```sh
composer install
```
Configure o .env
```sh
cp .env.example .env
```
Crie as tabelas no banco de dados
```sh
php artisan migrate
```

Rode os comandos para a build do frontend
```sh
npm install
npm run dev
```


## Contribuindo

1. Faça um fork do projeto  (<https://github.com/Caue-dot/easy-poll/fork>)
2. Crie uma branch para sua funcionalidade (`git checkout -b feature/nova-feature`)
3. Faça um commit das suas alterações (`git commit -m 'Nova feature'`)
4. Envie suas alterações para o GitHub (`git push origin feature/nova-feature`)
5. Abra um Pull Request

