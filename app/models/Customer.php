<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Customer extends BaseModel {

    protected $table = 'customers';

    /**
     * Soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    public static $unguarded = true;

}
