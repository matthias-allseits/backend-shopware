# backend-shopware

Projekt für eine provisorische API als Backend für die Entwicklung einer Vue App, in welcher Komponenten für Shopware entwickelt werden.

## Project Setup

```sh
git clone
cd backend-shopware
composer install
```

### Settings

```sh
Necessary: A running shopware container
Adjust .env to get access to its database
symfony server:start
```

### Run Server for Development

```sh
symfony server:start
```

### First endpoint

```sh
GET http://localhost:8000/api/config
```
