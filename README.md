# AtomPHP

**AtomPHP** é um micro-framework PHP simples e eficiente, ideal para projetos pequenos e médios que precisam de uma base enxuta, organizada e funcional. O foco do AtomPHP é oferecer uma estrutura rápida para criação de aplicações web em PHP, com rotas, controllers, views e banco de dados de forma clara e objetiva.

## 🚀 Recursos

- Estrutura MVC básica (Model-View-Controller)
- Sistema simples de rotas
- Suporte a controllers e views
- Autoload de classes via PSR-4 (Composer)
- Configuração por arquivos `.env`
- Pronto para integração com banco de dados

## 📁 Estrutura do Projeto

```
atomphp/
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
├── core/
│   ├── App.php
│   ├── Controller.php
│   └── Route.php
├── public/
│   └── index.php
├── .env
├── composer.json
└── LICENSE
└── README.md
```

- **app/**: Contém o código da aplicação (controllers, models e views).
- **core/**: Contém o núcleo do framework, como roteamento e carregamento das classes.
- **public/**: Diretório público que contém o ponto de entrada da aplicação (`index.php`).
- **.env**: Arquivo de configuração com variáveis de ambiente.
- **composer.json**: Define dependências do projeto.

## 🧩 Requisitos

- PHP 7.4 ou superior
- Composer instalado globalmente

## 🔧 Instalação

Siga os passos abaixo para configurar o projeto localmente:

1. **Clone este repositório:**

```bash
git clone https://github.com/aldecirfonseca/atomphp.git
```

2. **Acesse o diretório do projeto:**

```bash
cd atomphp
```

3. **Instale as dependências via Composer:**

```bash
composer install
```

4. **Renomeie o arquivo `.env.example` para `.env`:**

```bash
cp .env.example .env
```

5. **Configure as variáveis de ambiente no arquivo `.env`.**  
   Altere as configurações conforme seu ambiente (ex: banco de dados, ambiente de desenvolvimento, etc).

6. **Configure seu servidor web para apontar para o diretório `public/` como raiz do projeto.**  
   Se estiver usando o PHP embutido, você pode rodar com:

```bash
php -S localhost:8000 -t public
```

7. **Acesse sua aplicação no navegador:**

```
http://localhost:8000
```

## ▶️ Como Usar

- Toda requisição entra pelo `public/index.php`.
- As rotas são geradas com base nos controllers em `app/controllers/`.
- Os métodos dos controllers são chamados de acordo com a URL.
- As views são carregadas a partir de `app/views/`.

**Exemplo de URL:**

```
http://localhost/usuario/listar
```

Essa URL chamará o método `listar()` da classe `UsuarioController`.

## 🤝 Contribuindo

Contribuições são bem-vindas! Para contribuir com este projeto:

1. Faça um **fork** do projeto.
2. Crie uma nova branch com sua feature ou correção:

```bash
git checkout -b minha-feature
```

3. Commit suas alterações:

```bash
git commit -m 'Adiciona minha nova feature'
```

4. Envie para o seu repositório remoto:

```bash
git push origin minha-feature
```

5. Abra um **Pull Request** detalhando suas alterações.

## 📄 Licença

Este projeto está licenciado sob a **MIT License**.  
Consulte o arquivo [LICENSE](LICENSE) para mais informações.

## 👤 Autor

Desenvolvido por **Aldecir Fonseca**  
GitHub: [@aldecirfonseca](https://github.com/aldecirfonseca)

---

**AtomPHP** — Simples. Direto. Funcional.
