<?php

namespace Appel\MonetaryAttributes;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    /**
     * The model's registered money attributes
     *
     * @var array
     */
    protected $moneyAttributes = [];

    /**
     * Take a cent-based attribute and format it as a float-castable dollar based string
     *
     * @param  integer $attribute
     * @return string|mixed
     */
    protected function mutateForDisplay($attribute)
    {
        return number_format($attribute / 100, 2, '.', '');
    }

    /**
     * Turn a dollar based float value into a cent-based integer
     *
     * @param  mixed $attribute
     * @return integer
     */
    protected function mutateForStorage($attribute)
    {
        return (int) round($attribute * 100);
    }

    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string $key
     * @return bool
     */
    public function hasGetMutator($key)
    {
        return $this->isMoneyAttribute($key) ?: parent::hasGetMutator($key);
    }

    /**
     * Get the value of an attribute using its mutator.
     *
     * @param  string $key
     * @param  mixed $value
     * @return mixed
     */
    protected function mutateAttribute($key, $value)
    {
        if ($this->isMoneyAttribute($key)) {
            return $value ? $this->mutateForDisplay($value) : $value;
        }

        return parent::mutateAttribute($key, $value);
    }

    /**
     * Determine if a set mutator exists for an attribute.
     *
     * @param  string $key
     * @return bool
     */
    public function hasSetMutator($key)
    {
        return $this->isMoneyAttribute($key) ? true : parent::hasSetMutator($key);
    }

    /**
     * Set the value of an attribute using its mutator.
     *
     * @param  string $key
     * @param  mixed $value
     * @return mixed
     */
    protected function setMutatedAttributeValue($key, $value)
    {
        if ($this->isMoneyAttribute($key)) {
            $value = $this->mutateForStorage($value);
        }

        return $this->attributes[$key] = $value;
    }

    /**
     * Determine if this attribute is a special "display-only" attribute
     *
     * @param  string $key
     * @return bool
     */
    protected function isMoneyAttribute($key): bool
    {
        return in_array($key, $this->moneyAttributes);
    }

    /**
     * Get the mutated attributes for a given instance.
     *
     * @return array
     */
    public function getMutatedAttributes()
    {
        return array_merge(parent::getMutatedAttributes(), $this->moneyAttributes);
    }
    
    /**
     * Set the mutated attributes at runtime.
     *
     * @param array $moneyAttributes
     * @return Order
     */
    public function setMoneyAttributes(array $moneyAttributes): Order
    {
        $this->moneyAttributes = $moneyAttributes;

        return $this;
    }
    
    /**
     * @return array
     */
    public function getMoneyAttributes(): array
    {
        return $this->moneyAttributes;
    }
}

