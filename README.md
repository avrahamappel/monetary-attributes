**Note: This repository is abandoned in favor of [Eloquent Custom Casts](https://laravel.com/docs/7.x/eloquent-mutators#custom-casts), which were introduced in Laravel 7.**

You can replicate the functionality of this package using Eloquent Custom Casts with the following Cast class:

```php
<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Currency implements CastsAttributes
{
    /**
     * Cast the given value into currency format.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return number_format((int) $value / 100, 2, '.', '');
    }

    /**
     * Cast the given value back into an integer for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return int
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return (int) round((float) $value * 100);
    }
}

```


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
