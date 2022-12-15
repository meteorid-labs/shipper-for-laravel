<?php

namespace Meteor\Shipper\Models;

use Meteor\Shipper\Base\Model;

class Rate extends Model
{
    protected $guarded = [];

    public function logistic()
    {
        return $this->belongsTo(Logistic::class);
    }
}
