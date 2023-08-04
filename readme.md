# PHP RESTful Bible API

Bible RESTful API developed with pure PHP, without any major frameworks. Uses bibles in JSON format.

I developed this project for some reasons: 
- To study pure PHP without a framework environment
- Study API RESTful standards
- Study automatic tests with PHPUnit
- Study API documentation with open api and swagger
- While also working with something dear to me

You can see the project live at https://php-bible-api.vercel.app/.

## Requirements

- PHP 8.0.*
- Composer

## How to use

You can start the project at http://localhost:8000 by running the following commands:

```
composer install
```

```
composer serve
```

The API has only two endpoints, wich are explained in the main page.

You can get bible verses on api/{language abbreviation}/{version abbreviation}/{book abbreviation}/{chapter}/{verses}.

You can access the API information on available languages and version on api/info.

## How to add new languages and versions

You can add new languages and versions in three steps:

- First you need the bible in json format, following the same structure of the books already in the src/bibles directory.
- Then you need to create a new service in the src/services/localization directory, if it is a new language, or just add the new version to the already created service of given language.
- Finally, if you created a new service for a new language, declare the new service in src/controllers/BibleController.

## Pictures

![alt text](https://github.com/gsilverio7/PHPBibleAPI/blob/master/pictures/phpbibleapi.png)



