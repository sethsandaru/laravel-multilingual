# Laravel Multilingual
Laravel Multilingual is a library to help you to dealing with the multi-languages text on your website.

In the perfect case, we will dealing with the language bundle text dynamically from the database. So main advantages should be:   
- Very dynamic, flexible.
- No need to touch the static language files (in `resources/lang/...`).
- Available to deal with all languages in the world.
- Live editing the language text from the backend-side.

Supported: Laravel **5.5+**

Status: **In Development**

## Dependencies
- PHP
- Laravel framework
- Database
- VueJS (for backend pages)

## How to use?
### Install the package
```php
composer require sethsandaru/laravel-multilingual
```
### Run Migration and Publish Assets
```php
php artisan migrate
php artisan vendor:publish --tag=multilingual --force
```

### Custom Configuration
While you publish the vendor's assets. The configuration file should we published too, name: `config\multilingual.php`

Full description in file for each configuration, check it out.

## APIs
To be updated...

## Supporting the project
If you really like this project & want to contribute a little for the development. You can buy me a coffee. Thank you very much for your supporting <3.

<a href="https://www.buymeacoffee.com/xKOM9NB8p" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: auto !important;width: auto !important;" ></a>

Copyright &copy; 2018 by [Seth Phat](https://sethphat.com) aka Phat Tran Minh!