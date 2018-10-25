<?php

namespace Tests;

use Appel\MonetaryAttributes\Model as Eloquent;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** @mixin \Eloquent */
class Model extends Eloquent
{
    protected $guarded = ['id'];
    protected $moneyAttributes = ['price'];
}

class DisplayAttributesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function test_displays_monetary_attributes_correctly()
    {
        $model = Model::create(['price' => 599]);

        self::assertEquals('5.99', $model->price);
    }

    public function test_displays_monetary_attributes_correctly_in_array()
    {
        $model = Model::create(['price' => 599]);

        self::assertEquals('5.99', $model->toArray()['price']);
    }

    public function test_stores_display_monetary_attribute_in_base_attribute()
    {
        $model = Model::create(['price' => 599]);

        self::assertEquals(599, $model->getAttributes()['price']);
    }
}
