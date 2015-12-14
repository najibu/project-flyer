<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
class Flyer extends Model
{
	/**
     * Fillable fields for a flyer.
     *
     * @var array
     */
	protected $fillable = [
		'street',
        'city',
        'zip',
        'state',
        'country',
        'price',
        'description',
	];


    /**
     * Find the flyer at the given address.
     *
     * @param Builder $query
     * @param string $zip
     * @param string $street
     * @return Builder
     */
    public static function LocatedAt($zip, $street)
    {
        $street = str_replace('-', ' ', $street);

        return static::where(compact('zip', 'street'))->firstOrFail();
    }

    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

	/**
     * A flyer is composed of many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
    	return $this->hasMany('App\Photo');
    }

    /**
     * A flyer is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Determine if a given user created a flyer.
     *
     * @param User $user
     * @return boolean
     */
    public function ownedBy(User $user)
    {
        return $this->user == $user_id;
    }

}
