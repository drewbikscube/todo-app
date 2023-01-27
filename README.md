# Setup

Install Homebrew

`/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"`

Install PHP

`brew install php`

Install MySQL

`brew install mysql`

Install Composer

`brew install composer`


Navigate to the root directory `cd /todo-app`

`composer install`

`php artisan migrate`

`php artisan serve`


# To run tests

`vendor/bin/phpunit`