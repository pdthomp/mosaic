<img src='output/color_sort.png' style='width:100%;'>
<?php
$start = microtime(true);

require __DIR__.'/vendor/autoload.php';
include('crayons.php');

// $crayons = $crayons2;
$segmentWidth = 10;
$segmentHeight = 50;
$widthMarker = 0;
$image = new Imagick;
$image->newImage( count($crayons) * $segmentWidth, $segmentHeight, new ImagickPixel('black') );

usort($crayons, "calculateLuminosity");

foreach ($crayons as $key => $value) {
  $color = "rgb($value[0], $value[1], $value[2])";
  $segmentImage = new Imagick;
  $segmentImage->newImage( $segmentWidth, $segmentHeight, new ImagickPixel($color) );
  $segmentImage->setImageFormat('png');

  $image->compositeImage( $segmentImage, Imagick::COMPOSITE_DEFAULT, $widthMarker, 0);
  $widthMarker += $segmentWidth;
}

$image->setImageFormat ("png");
$image->writeImage ("output/color_sort.png");


function calculateLuminosity( &$a, $b ){
  $aDistance = calculateDistanceFromBlack($a);
  $bDistance = calculateDistanceFromBlack($b);

  if ( $aDistance > $bDistance ){
    return 1;
  } else if ( $aDistance < $bDistance ){
    return -1;
  } else if ( $aDistance == $bDistance ){
    return 0;
  }
}

d($crayons);

function calculateDistanceFromBlack( $color ) {
  $distance = pow( $color[0] - 0, 2 )+pow( $color[1] - 0, 2 )+pow( $color[2] - 0, 2 );
  return $distance;
}

$endTime = microtime(true) - $start;
d($endTime);