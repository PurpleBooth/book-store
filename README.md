# Book Store Demo

This is the demo project showing how to use swagger with a symfony 
project. 

The things you should look at in this project are:

* [The swagger file](contract.json)
* [Validating your specification's implementation](features/bootstrap/FeatureContext.php)
* Generating a client and models from the spec `./vendor/bin/jane-openapi generate`
* [Getting real objects to work with in your controller](src/AppBundle/Controller/DefaultController.php)
* [Nice documentation](http://localhost:8000/documenation)

## Getting Started

These instructions will get you a copy of the project up and running on 
your local machine.

### Prerequisities

You'll need:

* PHP 7 or greater
* Composer

### Installing

Simply run

```
composer install
```

Then

```
./bin/console server:run
```

And visit [http://127.0.0.1:8000/documentation](http://127.0.0.1:8000/documentation)

## Running the tests

### Behat

Ensure the server is running then run:

```
./vendor/bin/behat
```

## Built With

* [symfony](https://symfony.com/) - Symfony is a set of reusable PHP components and a PHP framework for web projects
* [jane/open-api](https://github.com/janephp/openapi) - Generate a PHP Client API (PSR7 compatible) given a OpenAPI (Swagger) specification.
* [fitbug/guzzle-swagger-validation-middleware](https://github.com/fitbug/guzzle-swagger-validation-middleware) - A guzzle middleware that can be used to validate if requests and responses match what is defined in the schema 
* [swagger-ui](http://swagger.io/swagger-ui/) - Swagger UI is a dependency-free collection of HTML, Javascript, and CSS assets that dynamically generate beautiful documentation and sandbox from a Swagger-compliant API. 

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/purplebooth/book-store/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/purplebooth/book-store/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
