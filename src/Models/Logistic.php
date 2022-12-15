<?php

namespace Meteor\Shipper\Models;

use Meteor\Shipper\Base\Model;

class Logistic extends Model
{
    protected $guarded = [];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
