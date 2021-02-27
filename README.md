Treinamento Dev-brabo 2021

**Link com toda descrição sobre o desafio**

https://www.notion.so/Getting-Started-In-Vue-c05feab996a44e3e9fa242678d25efd5

# Getting Started In Vue

## 👋 Bem vindo ao desafio dev-brabo!

### Coisas que você precisa fazer antes de começar

- Primeiros passos

  - [ ] Clone o repositorio do git

  [claudinei-casa/Treinamento-Dev-Brabo](https://github.com/claudinei-casa/Treinamento-Dev-Brabo)

  - [ ] Instale o Postman caso não tenha
  - [ ] Configurar seu Banco de dados
  - [ ] Na pasta Back-End configure o arquivo .env

- Execute os comandos de configuração na pasta Back-End

  - [ ] composer install
  - [ ] php artisan migrate:fresh --seed
  - [ ] php artisan passport:install
  - [ ] php artisan key:generate

- Execute os comandos na pasta Front-End
  - [ ] npm install

### Pronto agora vamos começar com nosso desafio!!!

A ideia central desse projeto e criar uma pagina onde uma empresa podera colocar uma serie de cards com todos os seus serviços, e uma dashboard onde ela podera adicionar, editar ou excluir cada card de acordo com sua vontade.

Cada card deve possuir um **icone**, um **titulo** e uma **descrição**

Para facilitar sua vida vamos te ajudar em cada etapa

Antes de tudo vc deve iniciar seu Back-End, você pode fazer isso com o seguinte comando

```bash
php artisan serve
```

Agora vc ja deve conseguir acessar as rotas atraves do Postman

Va agora para nossa pasta Front-End e execute o seguinte comando para iniciar o projeto

```bash
npm run dev
```

Apartir de agora e só codar a vontade, uma coisa que nós programadores gostamos bastante correto ⌨️

Existe um componente Servicos.vue ja criado dentro dos seus componetes globais, é nele que vc vai codar seus cards, uma dica é que você não se esqueça de criar uma props vc vai precisar dela 😉, vou deixar o link do guia aqui em baixo:

[](https://gitlab.com/ecomp-ufpr/cat-logos/front-enc/props)

Dentro da pasta Pages existe a pagina index onde voĉe pode criar todas a sua pagina. Lembre-se sempre de importar seus componetes nela.

Dentro dela voce vai criar se asyncData ( ), está lembrado dele?Voce pode entender como ela funciona acessando nosso guia :

[](https://gitlab.com/ecomp-ufpr/cat-logos/front-enc/async-data)

logo após uma dica é passar esses dados para a props do seu componente esta lembrando dela?

E Agora pra finalizar vamos para nossa Dashboard

Basicamente na sua dashboard vc precida dos campos necessarios para editar, excluir ou adicinar mais serviços se estiver com muitas duvidas pode checar as capacitaçoẽs passadas que estão no nosso drive, existe uma aula so explicando como faze-la.
