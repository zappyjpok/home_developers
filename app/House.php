<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model {

    protected  $table = 'houses';
    // safe from javascript injection
    protected $fillable= ['name', 'description'];

    public function HouseImages()
    {
        return $this->hasMany('App\HouseImages');
    }

    public function features()
    {
        return $this->belongsToMany('App\Feature', 'house_feature')->withTimestamps();
    }

    public function featureImages()
    {
        return $this->hasManyThrough('App\FeatureImages', 'featureImages', 'feature_id')->withTimestamps();
    }

}
