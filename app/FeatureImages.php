<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class FeatureImages extends Model {

	protected  $table = 'featureImages';
	// fillable fields
    protected $fillable= ['Image', 'ImagePath'];


    /**
     * Class FeatureImages
     * @package App
     * featureImages belongs to feature
     */
    public function owner()
    {
        return $this->belongsTo('App\Feature');
    }

    public function house()
    {
        return $this->hasManyThrough('App\FeatureImages', 'featureImages', 'feature_id')->withTimestamps();
    }

}
