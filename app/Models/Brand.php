<?php

require_once VENDOR.'/framework/Model.php';

class Brand extends Model
{
    protected static $table = 'brands';
    protected static $primaryKey = 'id';
}
