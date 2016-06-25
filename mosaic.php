<?php

echo "<img src='output/color_sort.png' style='width:100%;'>";

require __DIR__.'/vendor/autoload.php';
include('crayons.php');

$crayon = $crayons2;


d(count($crayons));


$image = new Imagick;
$image->newImage( count($crayons) * 10, 50, new ImagickPixel('gray') );
$image->setImageFormat ("png");
$image->writeImage ("output/color_sort.png");


$mosaicImage->compositeImage( $$crayonColor, Imagick::COMPOSITE_DEFAULT, 10, 50);
$widthMarker += $maskImageWidth;



foreach ($crayons as $key => $value) {
	// d($key);


}


$start = microtime(true);
$endTime = microtime(true) - $start;

// d($endTime);



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