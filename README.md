# Duorg

## 👨‍💻Integrantes
- Daniel Araujo Debastiani- 2210875
- Eduardo Zoldan Debastiani - 2210169
- Gabriel Homsi Gonçalves de Almeida - 2210364
- Gustavo Maia Moreira - 2211155
- Hercules Gabriel Araújo Câmara - 2310953
- Lucas Oliveira Santiago - 2210370
- Luis Felipe Borges Rosa - 2211829
- Rafael Luiz Pires Lima - 2211814
- Matheus de Paula Costa Cavalcante - 2210950


## 📁 Estrutura de Pastas

Abaixo está a estrutura de pastas do projeto para facilitar a navegação:

```
├── app
│   ├── Http
│   │   ├── Controllers        # Controladores da aplicação
│   │   ├── Middleware         # Middlewares personalizados
│   │   ├── Requests           # Requests de autenticação
│   ├── Models                 # Modelos Eloquent
│   ├── Providers              # Providers de serviços
│   ├── Services               # Classes de serviço para lógica de negócio
├── bootstrap                  # Arquivos de inicialização
├── config                     # Configurações do sistema
├── database                   # Arquivos de migração
├── public                     # Diretório público para assets e o index.php
├── resources                  # Views, templates e arquivos front-end
├── routes                     # Arquivos de rotas
│   ├── api.php                # Rotas de API
│   ├── auth.php               # Rotas de autenticação
│   ├── hospital.php           # Rotas relacionadas a hospitais
│   ├── user.php               # Rotas relacionadas a usuários
├── storage                    # Arquivos gerados pela aplicação
├── tests                      # Testes unitários e funcionais
├── .editorconfig              # Configurações de formatação para editores
├── .gitattributes             # Configurações específicas do Git
├── .gitignore                 # Arquivos ignorados pelo Git
├── artisan                    # Console do Laravel
├── composer.json              # Dependências do PHP e autoload
├── composer.lock              # Versões bloqueadas das dependências
├── docker-compose.yml         # Configuração do Docker Compose
├── phpunit.xml                # Configuração de testes
├── postcss.config.js          # Configuração do PostCSS
├── README.md                  # Documentação do projeto
├── tailwind.config.js         # Configuração do Tailwind CSS
```

---

## Funcionalidades

- **Autenticação de Usuários**: Login, logout e criação de novos usuários com autenticação via tokens.
- **Cadastro de Endereços**: Cadastro de endereços de hospitais e usuários.
- **Cadastro de Hospitais**: Inclusão de hospitais com seus respectivos endereços e informações.
- **Cadastro de Usuários**: Cadastro de usuários, que podem ser doadores, receptores ou administradores, com informações pessoais e médicas.
- **Busca e Filtro de Usuários**: Filtro de usuários por tipo e órgãos a serem doados.
- **Administração de Perfis de Usuários**: Perfis que definem o tipo de usuário no sistema (Administrador, Receptor, Doador).

## Arquitetura

- **MVC**: O projeto utiliza o padrão MVC (Model-View-Controller) para estruturação do código.
- **Serviços**: A lógica de negócios é encapsulada em serviços como `AuthService`, `AddressService`, `HospitalService` e `UserService`.
- **Banco de Dados**: O projeto utiliza o MySQL para armazenamento de dados, com migrações para criação das tabelas necessárias.

## Pré-requisitos

Antes de começar, verifique se você tem as seguintes dependências instaladas:

- [PHP >= 8.0](https://www.php.net/)
- [Laravel >= 9.x](https://laravel.com/docs/9.x)
- [MySQL](https://www.mysql.com/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) e [npm](https://www.npmjs.com/)



## Estrutura de Diretórios

- `app/Models`: Contém os modelos de dados, como `User`, `Hospital`, `Address`, `MedicalInfo`, etc.
- `app/Services`: Contém a lógica de negócios, como `AuthService`, `AddressService`, `HospitalService`, `UserService`.
- `database/migrations`: Contém os arquivos de migração para criação das tabelas no banco de dados.
- `routes/web.php`: Arquivo que define as rotas HTTP da aplicação.



## 📑 Rotas da API

**Todas necessitam do /api/**

### Rotas Públicas

Essas rotas estão acessíveis sem autenticação:

#### **Autenticação**
| Método | Endpoint     | Descrição                          |
|--------|--------------|------------------------------------|
| POST   | `/register`  | Cria um novo usuário.             |
| POST   | `/login`     | Realiza login e retorna um token. |

---

### Rotas Protegidas (Requerem Autenticação)

As rotas abaixo requerem um token válido via middleware `auth:sanctum`.

#### **Autenticação**
| Método | Endpoint     | Descrição                          |
|--------|--------------|------------------------------------|
| POST   | `/logout`    | Realiza logout do usuário.        |

#### **Usuários**
| Método | Endpoint         | Descrição                                    |
|--------|------------------|----------------------------------------------|
| GET    | `/users`         | Lista usuários com paginação e filtros.      |
| GET    | `/users/{id}`    | Retorna as informações de um usuário pelo ID.|

#### **Hospitais**
| Método  | Endpoint        | Descrição                                  |
|---------|-----------------|--------------------------------------------|
| GET     | `/hospitals`    | Lista todos os hospitais.                 |
| POST    | `/hospitals`    | Cria um novo hospital.                    |
| GET     | `/hospitals/{id}` | Retorna os detalhes de um hospital.      |
| PUT     | `/hospitals/{id}` | Atualiza os dados de um hospital.        |
| DELETE  | `/hospitals/{id}` | Remove um hospital pelo ID.              |

---

## 🌐 Testando a API

- Use ferramentas como [Postman](https://www.postman.com/) ou [Insomnia](https://insomnia.rest/) para testar os endpoints.
- Certifique-se de registrar um usuário e realizar login para obter o token de autenticação antes de acessar as rotas protegidas.

Adicione o cabeçalho de autorização para as rotas protegidas:

```
Authorization: Bearer <seu-token-aqui>
```

---

## 🛠️ Tecnologias Utilizadas

- **Laravel**: Framework PHP para desenvolvimento backend.
- **Sanctum**: Para autenticação baseada em tokens.
- **MySQL**: Banco de dados utilizado.

---

## 🚀 Como Executar o Projeto

1. Clone o repositório:
   ```bash
   git clone https://github.com/Daniel-Debastiani/duorg
   cd /duorg/
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Configure o ambiente:
   - Renomeie o arquivo `.env.example` para `.env`.
   - Ajuste as variáveis de ambiente, como as credenciais do banco de dados.
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=cookie
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="${APP_NAME}"

SANCTUM_STATEFUL_DOMAINS=localhost
SANCTUM_COOKIE_DOMAIN=localhost

# Configurações do JWT (caso use JWT para autenticação)
JWT_SECRET=your_jwt_secret

# URLs de API e OAuth (caso tenha)
OAUTH_CLIENT_ID=your_oauth_client_id
OAUTH_CLIENT_SECRET=your_oauth_client_secret

# Configurações do Redis para cache (opcional)
REDIS_CACHE_HOST=127.0.0.1
REDIS_CACHE_PASSWORD=null
REDIS_CACHE_PORT=6379

# Configurações do serviço de autenticação (se usar um provedor externo)
AUTH_PROVIDER=custom
```

4. Execute as migrações:
   ```bash
   php artisan migrate
   ```

5. Inicie o servidor:
   ```bash
   php artisan serve
   ```

6. Acesse o projeto:
   - URL padrão: [http://localhost:8000](http://localhost:8000)

---
