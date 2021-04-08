Grimlock PHP - Libraries & Utilities for PHP
======

<img src="https://i.imgur.com/l0WEzhA.png" width="256" alt="Grimlock">

Grimlock PHP is primarily a set of libraries and utilities written in PHP.

*This document applies to the latest stable code which may not reflect the current 
release. For released code please
[navigate to the appropriate tag](https://github.com/GorillaSoft/grimlock-php/tags).*

----

Follow us on [![Twitter](http://twitter-badges.s3.amazonaws.com/twitter-a.png)](http://www.twitter.com/gorilla_soft).

---



## Features

 * Generation of PDF from HTML easily using Mapper DomPDF
 * Handle your own custom exceptions
 * Supports for manipulating a list of objects

 
## Requirements

 * PHP version 7.4 or higher

## Recommendations

Visit the wiki for more information:
https://github.com/GorillaSoft/grimlock-php/wiki

## Install with composer

To install with [Composer](https://getcomposer.org/), simply require the
latest version of this package.

```bash
composer require gorilla-soft/grimlock-php
```

Make sure that the autoload file from Composer is loaded.

```php
// somewhere early in your project's loading, require the Composer autoloader
// see: http://getcomposer.org/doc/00-intro.md
require 'vendor/autoload.php';

```

## Quick Start

#### GrimlockPdf

```php
use Grimlock\GrimlockPdf;
use Grimlock\Enum\EnumPdfOrientation;
use Grimlock\Enum\EnumPdfSize;
use Grimlock\Exception\GrimlockException;

// Instantiate Grimlock GrimlockPdf
$grimlockPdf = new GrimlockPdf();
try {
    // Load file template HTML
    $grimlockPdf->loadHTML('template.html.php', EnumPdfSize::A4, EnumPdfOrientation::HORIZONTAL);
    // Generate PDF
    $grimlockPdf->generatePDF('example.pdf');
} catch(GrimlockException $e) {
    echo $e->getMessage();
}
```

#### ArrayList

```php
use Grimlock\Util\GrimlockList;

// Instantiate and use the GrimlockList
$lArray = new GrimlockList();

// Append object in the GrimlockList
$object1 = new Objet();
$lArray->append($object1);

// Obtain object of the GrimlockList
$object = $lArray->getItem(0);

```

---
