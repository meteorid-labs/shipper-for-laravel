<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Meteor\Shipper\Base\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->prefix.'rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logistic_id')->constrained($this->prefix.'logistics')->cascadeOnDelete();
            $table->unsignedInteger('shipper_id');
            $table->string('name');
            $table->string('type_name');
            $table->unsignedInteger('volumetric')->default(0);
            $table->unsignedInteger('min_kg')->default(0);
            $table->unsignedInteger('max_kg')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->prefix.'rates');
    }
};
