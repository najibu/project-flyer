<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;
use App\Flyer;
use App\AddPhotoToFlyer;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPhotoRequest;

class PhotosController extends Controller
{
    /**
     * Apply a photo to the referenced flyer.
     *
     *
     * @param  string  $zip
     * @param  string  $street
     * @param  AddPhotoRequest  $request
     */
    public function store($zip, $street, AddPhotoRequest $request)
    {
    	$flyer = Flyer::locatedAt($zip, $street);  
		$photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();
    } 

    public function destory($id)
    {
    	Photo::findOrFail($id)->delete();

    	return back();
    }
}
