<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait ImageHandlerTrait {
	public function uploadImage(Request $request, $path) {
        if ($request->image) {
            if (!is_dir(public_path($path))) {
                mkdir(public_path($path), 0777, $rekursif = true);
            }
            $imageName = time(). '.' . $request->image->extension();;
            $location = public_path($path);
            $request->image->move($location, $imageName);
            // Image::make($request->image)->save($path.$imageName);
            $request->image = $imageName;
            return $imageName;
        }
    }

	public function unlinkImage($path, $imageName) {
        $image = str_replace('/', '\\', public_path($path.$imageName));
        if (file_exists($image)) {
            unlink($image);
        }
    }
}
