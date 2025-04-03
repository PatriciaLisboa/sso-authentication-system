# Sistema de Autenticação SSO

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![OAuth](https://img.shields.io/badge/OAuth-2.0-FF6B6B?style=for-the-badge)
![OpenID Connect](https://img.shields.io/badge/OpenID_Connect-FF6B6B?style=for-the-badge)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)

Um sistema de autenticação Single Sign-On (SSO) robusto e seguro, implementado com Laravel, que suporta OAuth 2.0 e OpenID Connect. Este projeto oferece uma solução completa para gerenciamento de autenticação, autorização e identidade digital.

## 🚀 Funcionalidades

- **Autenticação Multi-fator (MFA)**: Suporte a autenticação de dois fatores usando Google Authenticator
- **OAuth 2.0**: Implementação completa do protocolo OAuth 2.0 para autorização segura
- **OpenID Connect**: Suporte ao protocolo OpenID Connect para autenticação e gerenciamento de identidade
- **Gerenciamento de Clientes OAuth**: Interface intuitiva para criar e gerenciar clientes OAuth
- **Gerenciamento de Escopos**: Controle granular de permissões através de escopos OAuth
- **Gerenciamento de Tokens**: Visualização e revogação de tokens de acesso
- **Log de Auditoria**: Rastreamento completo de todas as ações realizadas no sistema
- **Interface Responsiva**: Design moderno e responsivo usando Bootstrap 5 e Bootstrap Icons
- **Dashboard Intuitivo**: Painel de controle com visão geral do sistema e acesso rápido às funcionalidades

## 🛠️ Tecnologias Utilizadas

- **Laravel 10**: Framework PHP para desenvolvimento web
- **Laravel Passport**: Implementação de OAuth 2.0 para Laravel
- **Bootstrap 5**: Framework CSS para design responsivo
- **Bootstrap Icons**: Biblioteca de ícones para interface moderna
- **Vite**: Ferramenta de build para assets frontend
- **SQLite**: Banco de dados para desenvolvimento (configurável para outros bancos)
- **PHP 8.3**: Versão mais recente do PHP com recursos modernos

## 📋 Pré-requisitos

- PHP 8.3 ou superior
- Composer 2.0 ou superior
- Node.js 18 ou superior e NPM
- Git

## 🔧 Instalação

1. Clone o repositório:
```bash
git clone git@github.com:PatriciaLisboa/SSO-Authentication-System.git
cd SSO-Authentication-System
```

2. Instale as dependências do PHP:
```bash
composer install
```

3. Instale as dependências do Node.js:
```bash
npm install
```

4. Copie o arquivo de ambiente e configure-o:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure o banco de dados no arquivo `.env`:
```bash
DB_CONNECTION=sqlite
```

6. Crie o arquivo do banco de dados SQLite:
```bash
touch database/database.sqlite
```

7. Execute as migrações:
```bash
php artisan migrate
```

8. Compile os assets:
```bash
npm run build
```

9. Inicie o servidor:
```bash
php artisan serve
```

10. Acesse a rota de configuração inicial para criar um usuário e cliente de teste:
```
http://127.0.0.1:8000/setup-test
```

## 🔐 Credenciais de Teste

Após executar a rota de configuração inicial, você pode fazer login com:

- **Email**: test@example.com
- **Senha**: password123

## 📚 Documentação da API

O sistema expõe endpoints OAuth 2.0 e OpenID Connect padrão:

- **Autorização**: `/oauth/authorize`
- **Token**: `/oauth/token`
- **UserInfo**: `/oauth/userinfo`
- **JWKS**: `/oauth/jwks`

### Exemplo de Uso da API

```bash
# Obter token de acesso
curl -X POST http://localhost:8000/oauth/token \
  -H "Content-Type: application/json" \
  -d '{
    "grant_type": "password",
    "client_id": "client-id",
    "client_secret": "client-secret",
    "username": "test@example.com",
    "password": "password123",
    "scope": "*"
  }'
```

## 🔍 Logs de Auditoria

O sistema mantém um registro detalhado de todas as ações realizadas, incluindo:

- Criação, atualização e exclusão de recursos
- Autenticações e autorizações
- Gerenciamento de tokens
- Alterações de configuração

## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

## 👤 Autora

**Patrícia Lisboa**

- GitHub: [@PatriciaLisboa](https://github.com/PatriciaLisboa)
- LinkedIn: [Patrícia Lisboa](https://www.linkedin.com/in/patricia-lisboa)

---

⭐️ Se você gostou deste projeto, considere dar uma estrela no GitHub!
