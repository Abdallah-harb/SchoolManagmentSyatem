<?php

namespace App\Trait;

trait imageTrait
{
    final public function image ($image,$folder){
        $rand= rand(999999, 1000000);
        $imageName = time().'_'.$rand. '.' . $image->getClientOriginalExtension();
        $image->storeAs('/public/'.$folder, $imageName);
        return $imageName;
    }
}
