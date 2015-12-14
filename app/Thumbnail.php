<?php

namespace App;

use Image;

class Thumbnail 
{
	public function make()
	{
		Image::make($this->path)
					->fit(200)
					->save($this->thumnail_path);
	}
}