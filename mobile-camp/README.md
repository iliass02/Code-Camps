# mobile-camp

Application réalisé avec le framwork Ionic

- Prérequis :
    - créer une base de données : mobile-camp
    - modifier les accès à la base de données en mettant vos identifiants MySQL (server/index.js - ligne 10/11)
    - importer les tables de la base de données à l'aide du fichier mobile-camp-tables.sql

- Installation

```shell
cd server
npm install
cd mobile-camp-app
npmm install && bower install
```

- Lancer l'API de l'application
```shell
cd server
node index.js
```

- Lancer l'application
```shell
cd mobile-camp-app
ionic serve --lab
```
