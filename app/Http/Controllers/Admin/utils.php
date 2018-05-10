<?php
function watermark($fileExtension, $linkSrc, $linkDes)
{
  if (empty($linkSrc) || !file_exists($linkSrc)) {
    
    //displays a error image if GET['i'] is empty
    
    $im = imagecreatefrompng(public_path() . '/images/logo_sghome_watermark.png');
    
    //keeps the transparency of the picture
    imagealphablending($im, false);
    imagesavealpha($im, true);
    
    // Output and free memory
    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
  } else {
    // Load the stamp and the photo to apply the watermark to
    $stamp = imagecreatefrompng(public_path() . '/images/logo_sghome_watermark.png');
    $get = $linkSrc;
    if (strtolower($fileExtension) == 'jpg' || strtolower($fileExtension) == 'jpeg') {
      $im = imagecreatefromjpeg($get);
    }
    if (strtolower($fileExtension) == 'png') {
      $im = imagecreatefrompng($get);
    }
    
    
    // get the height/width of the stamp image
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    $sximg = imagesx($im);
    
    //percentage of the size(5%)
    $percent = $sximg * 0.5;
    $percent_h = $sy * ($percent / $sx);
    //positionnig the stamp to the center
    $posx = round(imagesx($im) / 2) - round($percent / 2);
    $posy = round(imagesy($im) / 2);
    
    //Create the final resized watermark stamp
    $dest_image = imagecreatetruecolor($percent, $percent);
    
    //keeps the transparency of the picture
    imagealphablending($dest_image, false);
    imagesavealpha($dest_image, true);
    //resizes the stamp
    imagecopyresampled($dest_image, $stamp, 0, 0, 0, 0, $percent, $percent_h, $sx, $sy);
    
    // Copy the resized stamp image onto the photo
    
    imagecopy($im, $dest_image, round($posx), round($posy), 0, 0, $percent, $percent_h);
    
    // Output and free memory
    header('Content-type: image/jpg');
    imagejpeg($im, $linkDes, 100);
    imagedestroy($im);
  }
}

function createThumbnail($fileExtension, $linkSrc, $linkDes)
{
  if (empty($linkSrc) || !file_exists($linkSrc) || file_exists($linkDes)) {
    return;
  } else {
    $get = $linkSrc;
    $im = null;
    if (strtolower($fileExtension) == 'jpg' || strtolower($fileExtension) == 'jpeg') {
      $im = imagecreatefromjpeg($get);
    }
    if (strtolower($fileExtension) == 'png') {
      $im = imagecreatefrompng($get);
    }
    
    if ($im == null) {
      return;
    }
    
    // Get new sizes
    list($width, $height) = getimagesize($get);
    $new_height = 200;
    $ratio_wh = $width / $height;
    $new_width = $new_height * $ratio_wh;
    
    echo($width . '-' . $height . '-' . $new_width . '-' . $new_height . '-' . $ratio_wh . ' + ');
    
    // Create the final resized
    $dest_image = imagecreatetruecolor($new_width, $new_height);
    
    // Resize
    imagecopyresized($dest_image, $im, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    
    // Output and free memory
    header('Content-type: image/jpg');
    imagejpeg($dest_image, $linkDes, 100);
    imagedestroy($im);
  }
}
