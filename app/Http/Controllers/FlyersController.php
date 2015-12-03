<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Controller;
use App\Flyer;

class FlyersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // flash()->overlay('Welcome Aboard', 'Thank you for signing up.');

        return view('flyers.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FlyerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        // persist the flyer
        Flyer::create($request->all());

        // flash messaging
        // flash('Success!' ,'Your flyer has been created!');

        flash()->success('Success!' ,'Your flyer has been created!');

        // redirect to landing page
        return redirect()->back(); // temporary
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        
        return view('flyers.show', compact('flyer'));
    }

    /**
     * Apply a photo to the referenced flyer.
     *
     *
     * @param  string  $zip
     * @param  string  $street
     * @param  Request  $request
     */
    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

       $photo = Photo::fromForm($request->file('photo'));

       Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
