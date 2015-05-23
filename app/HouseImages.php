<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseImages extends Model {

    protected  $table = 'houseImages';
    // fillable fields
    protected $fillable= ['Image', 'ImagePath'];

    /**
     * Class HouseImages
     * @package App
     * featureImages belongs to feature
     */
    public function owner()
    {
        return $this->belongsTo('App\House');
    }

}
