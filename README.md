**Note: This repository is abandoned in favor of [Laravel Custom Casts](https://github.com/vkovic/laravel-custom-casts#laravel-custom-casts).**

# Monetary Attributes

**Monetary Attributes** is a package for Laravel / Eloquent when you need to store monetary units, and don't want to deal with all the complexities that come when storing in float / double formats. 

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

Inside your Eloquent model, define the model's monetary attributes in the `$moneyAttributes` property.

```php
...
class Product extends Model
{
    protected $moneyAttributes = ['price','sale_price'];
}
...
```

## To-Do

- [ ] Switch to trait instead of using inheritance
