<img src='output/color_sort.png' style='width:100%;'>
<?php
$start = microtime(true);

require __DIR__.'/vendor/autoload.php';
include('crayons.php');

$crayons = $crayons2;
$segmentWidth = 10;
$segmentHeight = 50;
$widthMarker = 0;
$image = new Imagick;
$image->newImage( count($crayons) * $segmentWidth, $segmentHeight, new ImagickPixel('black') );

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




function calculateClosestColor( $color, $crayons, &$distancesC ) {
  $distances = [];

  foreach ($crayons as $key => $crayon) {
    $distance = pow( $color[0] - $crayon[0], 2 )+pow( $color[1] - $crayon[1], 2 )+pow( $color[2] - $crayon[2], 2 );
    $distances[ $crayon[3] ] = $distance;
  }

  asort($distances);

  d($distances);

  $crayon = array_keys($distances, min($distances));

  return $crayon[0];
}

$endTime = microtime(true) - $start;
d($endTime);