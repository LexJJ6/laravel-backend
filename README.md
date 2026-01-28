# Laravel Backend

A aplicação é um sistema interno de gestão, pelo que todas as funcionalidades estão protegidas por autenticação. A página inicial corresponde à área de login.

# Instruções

git clone <url-do-repositorio>

composer install

cp .env.example .env (duplicar o ficheiro e renomear para .env se o sistema não tiver o comando cp)

php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan serve