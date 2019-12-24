# Laravel Multilingual
![Version 1.0.0](https://img.shields.io/badge/version-1.0.0-green) 
[![Total Viewers](http://hits.dwyl.io/sethsandaru/laravel-multilingual.svg)](http://hits.dwyl.io/sethsandaru/laravel-multilingual)

Laravel Multilingual is a library to help you to dealing with the multi-languages text on your website.

I'm working with a system serving 64+ countries and supported 80+ languages around the world. Basically I'm already got a good hand-on experience
dealing with multilingual. So it would be a great idea to create a Package for Laravel (my favorite framework while using PHP).

In the perfect case, we will dealing with the language bundle text dynamically from the database. So main advantages should be:   
- Super Dynamic & flexible to use.
- No need to touch the static language files (in `resources/lang/...`). It's a pain in the ass for the editors/translators to update the language text.
- Available to deal with all languages around the world.
- Live editing the language text from the backend-side with a good editor & UI.
- Cache-able to keep the performance rise.

Status: **v1.0.0 is available** 

## Supported Laravel Versions
| Version | Tested? | Supported? |
|---------|---------|------------|
| 6.x     | No      | ![Testing](https://img.shields.io/badge/supported-testing-yellow)           |
| 5.8     | Yes     | ![Supported](https://img.shields.io/badge/supported-yes-green)        |
| 5.7     | Yes     | ![Supported](https://img.shields.io/badge/supported-yes-green)        |
| 5.6     | No      | ![Testing](https://img.shields.io/badge/supported-testing-yellow)           |
| 5.5     | No      | ![Testing](https://img.shields.io/badge/supported-testing-yellow)           |
| 5.4     | No      | ![Testing](https://img.shields.io/badge/supported-testing-yellow)           |

## Ideas

### v1.0.0 - Static Language Text
- There will be Text Bundle and Text Bundle Item.
- Text Bundle is like a group of text items. Same as a single translation file in Laravel.
- Text Bundle Item is where you keep your translation text.
- All the management things (Add/Edit/Delete) are happen on the web-backend. No need to touch the code.
- Cache-ready

### v1.1.0 - Inject-able to specific Entity
- Planning...

## Dependencies/Technologies/Languages
- PHP7+
- Laravel framework
- Database (MySQL, MariaDB,...)
- Javascript (For backend pages):
    - JQuery
    - Bootstrap 4
    - DataTable
    - Underscore

## How to use?
### Install the package
```php
composer require sethsandaru/laravel-multilingual
```

### (Only for Laravel < 5.4) Inject Multilingual - ServiceProvider
Open to: `config\app.php`

Add this to `providers`:
```php
SethPhat\Multilingual\ServiceProvider::class
```

### Run Migration and Publish Assets
```php
php artisan migrate
php artisan vendor:publish --tag=multilingual --force
```

### Custom Configuration
After you published the vendor's assets. The configuration file should be published too, location: `config\multilingual.php`

Full description in file for each configuration, check it out.

Configuration file: [config/multilingual.php](https://github.com/sethsandaru/laravel-multilingual/blob/master/src/configs/multilingual.php)

### Management System / Backend Pages
This is where you can add/edit/delete the Language Text. By default, you can access the management backend from this url:  
```php
http(s)://<your_domain>/settings/multilingual
```

For the prefix, to change it you need to change it from the configuration file (detail above).

**Security**: You need to make sure that `custom_middleware` in the configuration file `multilingual.php` is set. 
Default setting is no-middleware so everybody can access (dangerous). It should be some specific users can access the Backend Page.

Example: `'custom_middleware => ['auth', 'admin']` => Logged in user and must be an Admin.

Available language in backend pages: English, Vietnamese (More, if you suggest).

## APIs/Functions/Helpers

### Get Translation Text
To get the translation text from the Bundle, you can use this function:   
```php
/**
* Get the translation text
* @param string $textKey Key Value of Text Bundle Item - Required
* @param string $moduleName Text Bundle Name - Required
* @param array $replaceText Same as Laravel Translation to replace text (My name is :name => ['name' => 'Seth Phat']) - Default: []
* @param string $specificLanguage Define the specific language to retrieve - Default: App::getLocale() - Current language
* @param boolean $should_throw Throw Exception when the text is not found or not. Default: false
*/
multilingual(string $textKey, string $moduleName, array $replaceText, string $specificLanguage, boolean $shouldThrow)
```

### Change Language
We're still based on `App`'s Locale of Laravel. So to change to another Language, you can:   
```php
App::setLocale($localeString); // $localeString is: en, vi, de,...
```

## Events
List of events that you can listen to handle:   
```php
// For Language
SethPhat\Multilingual\Libraries\Events\LanguageCreated - Will run after inserted a new language into database
SethPhat\Multilingual\Libraries\Events\LanguageRemoved - Will run after a language has been deleted

// For Text Bundle
SethPhat\Multilingual\Libraries\Events\TextBundleCreated - Will run after a text bundle has been created
SethPhat\Multilingual\Libraries\Events\TextBundleUpdated - Will run after a text bundle has been updated
SethPhat\Multilingual\Libraries\Events\TextBundleRemoved - Will run after a text bundle has been deleted

// For Text Bundle Item
SethPhat\Multilingual\Libraries\Events\TextBundleItemCreated - Will run after a text bundle item has been created
SethPhat\Multilingual\Libraries\Events\TextBundleItemUpdated - Will run after a text bundle item has been updated
SethPhat\Multilingual\Libraries\Events\TextBundleItemRemoved - Will run after a text bundle item has been deleted
```
## Tests
Run Unit Test (from Laravel Project):
```php
./vendor/bin/phpunit --bootstrap vendor/autoload.php vendor/sethsandaru/laravel-multilingual/
```

## Plans & Milestones
- **v1.0.0** - Translation for Static Text, including:
    - Management Page to Add/Edit/Remove the Static Text (Text Module)
    - Helper function to get the static text 
    - Serving the static text and caching mechanism
    - Released on 24/12/2019
- v1.0.1 - Translation for your own Entity/Table, including:
    - Easy to inject the Multilingual for your Entity/Table.
    - Prepared all the Class/Traits needed for Eloquent
    - Management your Entity/Table translation data in Management Page (Maybe?)
    - CI - TravisCI

## Supporting the project
If you really like this project & want to contribute a little for the development. You can buy me a coffee. Thank you very much for your supporting <3.

<a href="https://www.buymeacoffee.com/xKOM9NB8p" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: auto !important;width: auto !important;" ></a>

Copyright &copy; 2019 by [Seth Phat](https://sethphat.com) aka Phat Tran Minh!