<?php

namespace Meteor\Shipper\Base;

use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    /**
     * Create a new model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('meteor.shipper.database.table_prefix').$this->getTable());

        if ($connection = config('meteor.shipper.database.connection', false)) {
            $this->setConnection($connection);
        }
    }
}
