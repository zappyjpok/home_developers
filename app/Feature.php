<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Feature extends Model {

    // protect the table
    protected  $table = 'features';
	//Safe objects for array post
    protected $fillable= ['name', 'description'];


    /**
     * Class Feature
     * @package App
     * A feature can have many images
     */
    //
    public function FeatureImages()
    {
        return $this->hasMany('App\FeatureImages');
    }

}
