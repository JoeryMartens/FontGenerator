# Font Loader/Generator
Basic code to load webfonts automatically into your CSS file. This is a basic PHP code which you can use to load your webfonts but it's also possible to edit the code and create your own extensions. The fontloader/generator can save time when you want to declare the path to all your different webfont files. You only have to include one file (run it once) and the fonts will be automatically added to your CSS.

# How it works
In this section of the README you will be informed about the working of the code.

<h2> Webfont_declaration.php </h2>
This file will generate the CSS code. You have to put this file in the same directory as your font directory. 

<h3> Search for fontfiles </h3>

The code below search to all the fontsfiles in your fontdirectory and writes the filepaths and file-extensions in an array.  
```
$fonts = Array();
foreach (glob("fonts/*") as $filePath) {
	$part = explode('/', $filePath);
    $filename = end($part);
    $details = explode('.', $filename);
    $fonts[$details[0]][] = $details[1];
}
```

<h3> Generate @font-face declaration </h3>

After we wrote all the filepaths and file-extensions into an array, the code below will put this in an @font-face template. This code will do this for .EOT, .WOFF, .TTF and .SVG formats. At least it adds a normal font-weight and font-style to it and write all the different variables with content into one.
```
$FontContent = '';
foreach ($fonts as $fontname => $fonttypes) {
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
  
  $fontWeight = 'font-weight: normal;
  font-style: normal;
}';

$FontContent .= $first . $fontFamily . $eot . $eotIEfix . $woff . $ttf . $svg . $fontWeight;

```








