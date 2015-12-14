<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{

	protected $table = 'flyer_photos';

	protected $fillable = ['path', 'name' ,'thumbnail_path'];

    protected $file;


    /**
     * When a photo is created, prepare a thumbnail, too.
     *
     * @return void
     */
    protected static function boot()
    {
        static::creating(function ($photo){
            return $photo->upload();
        });
    }

	/**
     * A Photo belongs to a specific flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
    	return $this->belongsTo('App\Flyer');
    }

    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        return $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);
    }

    public function fileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name} . {$extension}";
    }

    public function filePath()
    {
        return $this->baseDir() . '/' . $this->fileName();
    }

    public function thumbnailPath()
    {
        return $this->baseDir() . '/tn-' . $this->fileName();
    }

    public function baseDir()
    {
        return 'image/flyers';
    }

    // public static function named($name)
    // {
    //     return (new static)->saveAs($name);
    // }

    // protected function saveAs($name)
    // {
    //     $this->name = sprintf("%s-%s", time(), $name);
    //     $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
    //     $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

    //     return $this;
    // }

    /**
     * Move the photo to the proper folder.
     *
     * @return self
     */
    public function upload()
    {
       $this->file->move($this->baseDir(), $this->fileName()); 

       $this->makeThumbnail();

        return $this;
    }

    /**
     * Create a thumbnail for the photo.
     *
     * @return void
     */
    protected function makeThumbnail()
    {
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }
    
}
