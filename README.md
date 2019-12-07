# Laravel Multilingual
Laravel Multilingual is a library to help you to dealing with the multi-languages text on your website.

I'm working and developing a system serving 64+ countries and supported 80+ languages around the world. Basically I'm already got a good hand-on experience
dealing with multilingual system. So it would be a great idea to create a Package for Laravel (my favorite framework).

In the perfect case, we will dealing with the language bundle text dynamically from the database. So main advantages should be:   
- Dynamic & flexible to use.
- No need to touch the static language files (in `resources/lang/...`). It's a pain in the ass for the editors/translators to update the language text.
- Available to deal with all languages around the world.
- Live editing the language text from the backend-side with a good editor & UI.
- Cache-able to keep the performance rise.

Supported: Laravel **5.5+**

Status: **In Development**

## Dependencies/Technologies/Languages
- PHP7+
- Laravel framework
- Database (MySQL, MariaDB,...)
- Javascript:
    - JQuery
    - Bootstrap 4
    - DataTable
    - Underscore

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
After you published the vendor's assets. The configuration file should we published too, name: `config\multilingual.php`

Full description in file for each configuration, check it out.

### Management System
By default, you can access the management backend from this url:  
```php
http(s)://<your_domain>/settings/multilingual
```

For the prefix, to change it you need to change it from the configuration file (detail above).

## APIs
To be updated...

## Events
List of events that you can listen to handle:   
```php
// For Language
SethPhat\Multilingual\Libraries\Events\LanguageCreated - Will run after inserted a new language into database
SethPhat\Multilingual\Libraries\Events\LanguageRemoved - Will run after a language has been deleted

// For Text Bundle
SethPhat\Multilingual\Libraries\Events\TextBundleCreated - Will run after a text bundle has been created (new record)

(more to come...)
```

## Plans & Milestones
To be updated....

## Supporting the project
If you really like this project & want to contribute a little for the development. You can buy me a coffee. Thank you very much for your supporting <3.

<a href="https://www.buymeacoffee.com/xKOM9NB8p" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: auto !important;width: auto !important;" ></a>

Copyright &copy; 2018 by [Seth Phat](https://sethphat.com) aka Phat Tran Minh!