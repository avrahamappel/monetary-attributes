<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Appel\MonetaryAttributes\Model as Eloquent;

class Model extends Eloquent
{
    protected $guarded = ['id'];
    protected $moneyAttributes = ['price'];
}

class DisplayAttributesTest extends TestCase
{
    public function test_displays_monetary_attributes_correctly()
    {
        $model = new Model(['price' => 5.99]);

        self::assertEquals('5.99', $model->price);
    }

    public function test_displays_monetary_attributes_correctly_in_array()
    {
        $model = new Model(['price' => 5.99]);

        self::assertEquals('5.99', $model->toArray()['price']);
    }

    public function test_stores_display_monetary_attribute_in_base_attribute()
    {
        $model = new Model(['price' => 5.99]);

        self::assertEquals(599, $model->getAttributes()['price']);
    }

    public function test_returns_null_if_value_is_not_set()
    {
        $model = new Model;

        self::assertNull($model->price);
    }
}
