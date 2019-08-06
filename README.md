# Monetary Attributes

**Monetary Attributes** is a package for Laravel / Eloquent when you need to store monetary units, and don't wanyt to deal with all the complexities that come when storing in float / double formats. 

With this package you would store the money field in cents (no decimal point), and the package will convert it to dollars when retrieving and back to cents on storage.

## Installation
Install the package via composer:
```
composer require appel/monetary-attributes
```

## Usage

When creating a Eloquent model, instead of extending the standard Laravel model class, extend from the model class provided by this package:

```php
<?php

namespace App;

use Appel\MonetaryAttributes\Model;

class Product extends Model
{
    //
}
```

Inside your Eloquent model

add protected property `$moneyAttributes` and pass in an array of fields that should be proccesed as monetary attributes

```php
...
class Product extends Model
{
    protected $moneyAttributes = ['price','sale_price'];
}
...
```
