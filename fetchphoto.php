<?php

		// Gets the photo from the photos folder so that it can be displayed in the thumbnail list

  			$picture_name = $_REQUEST['picture_name'];

 			$max_width = 250;
  			$max_height = 250;

  			$size = GetImageSize($picture_name);
  			$width = $size[0];
  			$height = $size[1];

  			$x_ratio = $max_width / $width;
  			$y_ratio = $max_height / $height;

  			if ( ($width <= $max_width) && ($height <= $max_height) ) {
    			$tn_width = $width;
    			$tn_height = $height;
  			}
  			else if (($x_ratio * $height) < $max_height) {
    			$tn_height = ceil($x_ratio * $height);
    			$tn_width = $max_width;
  			}
  			else {
    			$tn_width = ceil($y_ratio * $width);
    			$tn_height = $max_height;
  			}

  			$src =($picture_name);
  			$dst = ImageCreatetruecolor($tn_width,$tn_height);
  			ImageCopyResized($dst, $src, 0, 0, 0, 0,
  			    $tn_width,$tn_height,$width,$height);
  			header('Content-type: image/jpeg');
  			ImageJpeg($dst, null, -1);
  			ImageDestroy($src);
  			ImageDestroy($dst);

?>