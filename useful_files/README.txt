http://localhost:80
http://localhost:5555 - pgAdmin {pgadmin4@pgadmin.org} {root}
php bin/console doctrine:query:sql 'SELECT * FROM product'
php bin/console doctrine:migrations:migrate
php bin/console make:migration
