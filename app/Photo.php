<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        return 'images/photos';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir()  . '/tn-' . $name;
    }  

    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);
        
        parent::delete();
    }
    
}
