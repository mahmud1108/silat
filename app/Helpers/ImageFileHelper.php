<?php

namespace App\Helpers;

class ImageFileHelper
{

  public function upload($image_file, $path)
  {
    if ($image_file) {
      $image_file_path = $image_file->store($path, 'public');
      return 'storage/' . $image_file_path;
    }
  }

  public function delete($image_file)
  {
    if ($image_file) {
      if (file_exists(public_path($image_file))) {
        unlink(public_path($image_file));
      }
    }
  }

  public static function instance()
  {
    return new ImageFileHelper();
  }
}
