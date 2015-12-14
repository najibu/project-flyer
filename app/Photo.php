<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'flyer_photos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['path', 'name' ,'thumbnail_path'];

	/**
     * A Photo belongs to a specific flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
    	return $this->belongsTo('App\Flyer');
    }


    public function baseDir()
    {
        return 'image/flyers';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/'.$name;
        $this->thumnail_path = $this->baseDir() . '/tn-'.$name;
    }

    
}
