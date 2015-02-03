<?php

// put filepaths and file-extensions into an array 
$fonts = Array();
foreach (glob("fonts/*") as $filePath) {
	$part = explode('/', $filePath);
    $filename = end($part);
    $details = explode('.', $filename);
    $fonts[$details[0]][] = $details[1];
}


$FontContent = '';
foreach ($fonts as $fontname => $fonttypes) {


// Create font-template
  
  
  $first = '@font-face {';   
  $fontFamily = 'font-family: ' . $fontname . ';';
  
  foreach($fonttypes as $fonttype) {

	  
  if($fonttype == 'eot') {
	$eot = "src: url('../fonts/" . $fontname . ".eot');";
	$eotIEfix = "src: url('../fonts/" . $fontname . ".eot?#iefix') format('embedded-opentype'),";
  }
  elseif($fonttype == 'woff') {
	$woff = "src: url('../fonts/" . $fontname . ".woff') format('woff'),";
  }
  elseif($fonttype == 'ttf') {
  	$ttf = "src: url('../fonts/" . $fontname . ".ttf') format('truetype'),"; 
  }
  elseif($fonttype == 'svg') {
  	$svg = "src: url('../fonts/" . $fontname . ".svg') format('svg');";
	  
  } 
  
  }
  
  $fontWeight = 'font-weight: normal; font-style: normal;}';
  $FontContent .= $first . $fontFamily . $eot . $eotIEfix . $woff . $ttf . $svg . $fontWeight;
 
}


// Open or create fonts.css and write the @font-face content into this file

$myfile = fopen("fonts.css", "w") or die("Unable to open file!");
$txt = $FontContent;
fwrite($myfile, $txt);
fclose($myfile);
 
?>
