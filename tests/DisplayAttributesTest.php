<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Appel\MonetaryAttributes\Model as Eloquent;

class Model extends Eloquent
{
    protected $guarded = ['id'];
    protected $moneyAttributes = ['price'];
}

class ModelWithGetMutator extends Model
{
    public function getPriceAttribute($price)
    {
        return $price;
    }
}

class ModelWithSetMutator extends Model
{
    public function setPriceAttribute($price)
    {
        $this->attributes['price'] = $price;
    }
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

    public function test_prefers_get_mutator_method_if_one_exists()
    {
        $model = new ModelWithGetMutator(['price' => 5.99]);

        self::assertEquals(599, $model->price);
    }

    public function test_prefers_set_mutator_method_if_one_exists()
    {
        $model = new ModelWithSetMutator(['price' => 599]);

        self::assertEquals(599, $model->getAttributes()['price']);
    }
}
