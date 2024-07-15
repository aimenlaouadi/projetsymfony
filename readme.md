
# Projet Laouadi Aimen site hopital

## tous les lignes que j'ai utilisé pour c eprojet
symfony new my_project_directory --version=6.4 --webapp
 bin/console make:controller 
 php bin/console d:d:c
 php bin/console make:entity
composer require --dev orm-fixtures
composer require --dev fakerphp/faker
php bin/console make:form
php bin/console debug:autowiring entity
php bin/console debug:autowiring entity
php bin/console debug:autowiring Mailer
php bin/console make:form
php bin/console make:auth
php bin/console make:crud
composer require easycorp/easyadmin-bundle
php bin/console make:admin:dashboard
php bin/console make:admin:crud
php bin/console make:user
php bin/console debug:autowiring Password
php bin/console make:auth
php bin/console debug:container --tag=doctrine.event_subscriber 
### Projet
Comment j'ai réaliser mon projet:
``` installation des composant necessaire . j'ai créer mes page d'acceuil de manière dynamique en selectionnant chaque profile qui corespond à la base de données. j'ai créer mes entity, ensuite j'ai créer ma connection à la base de donées jai effectuer mes migrations. j'ai créer mon formulaire de contact avec le make:form ensuite je les liées à ma base donnée en plus de sa j'ai réaliser une validation par message grâce au mailtrap. j'ai réaliser la notification discord. j'ai créer des formulaires d'authentification pour le coté admin et upload (exemple url:http://127.0.0.1:8000/upload/104). j'ai créer de lauthenfication par token.


J'ai voulu faire ma barre de recherche mai sma,que de temps.