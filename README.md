# slim4-mustache-view

[![Latest Stable Version](https://poser.pugx.org/heinrichschiller/slim4-mustache-view/v)](//packagist.org/packages/heinrichschiller/slim4-mustache-view) 
[![Build Status](https://travis-ci.com/heinrichschiller/Slim4-Mustache-View.svg?branch=main)](https://travis-ci.com/github/heinrichschiller/Slim4-Mustache-View)
[![Total Downloads](https://poser.pugx.org/heinrichschiller/slim4-mustache-view/downloads)](//packagist.org/packages/heinrichschiller/slim4-mustache-view) 
[![Latest Unstable Version](https://poser.pugx.org/heinrichschiller/slim4-mustache-view/v/unstable)](//packagist.org/packages/heinrichschiller/slim4-mustache-view) 
[![License](https://poser.pugx.org/heinrichschiller/slim4-mustache-view/license)](//packagist.org/packages/heinrichschiller/slim4-mustache-view)

This class is a Slim Framework view helper built on top of the Mustache.php templating component.
Mustache.php is a PHP component created by Justin Hileman.

## Mustache.php Mainpage
https://github.com/bobthecow/mustache.php

## Installation

```bash
composer require heinrichschiller/slim4-mustache-view
```

## Usage

Add the Mustache settings in your Slim settings:

```php
...
// Example from, https://github.com/bobthecow/mustache.php/wiki#constructor-options
'mustache' => [
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../views'),
    'charset' => 'UTF-8',
],
...
```
Create the views-Directory and create the index.mustache file in the views-Directory, like this:

```html
<h1>Hello, {{ world }}</h1>
```
Next, define Mustache-Container like this:

```php
...

ViewInterface::class => function(ContainerInterface $container): ViewInterface
{
    $options = $container->get('settings')['mustache'];

    return new Mustache($options);
}

...
```

And create a container injection, like this:

```php
...

IndexAction::class => function(ContainerInterface $container): IndexAction
{
    return new IndexAction(
        $container->get(ViewInterface::class),
    );
}

...
```

At last create the action, like this:

```php

// IndexAction.php

declare( strict_types = 1 );

namespace App\Actions;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\View\Mustache;

class IndexAction
{
    private ViewInterface $view;

    public function __construct(ViewInterface $view)
    {
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response, array $args = []): Response
    {
        $response = $this->view->render($response, 'index', ['world' => 'World!']);

        return $response;
    }
}

```

Now call your IndexAction and if you were successful you will see this result.


<h1>Hello, World!</h1>

## More about Mustache.php?
Read [the Mustache.php documentation](https://github.com/bobthecow/mustache.php/wiki/Home) for more information.

## Testing

```bash
phpunit
```

Have fun!