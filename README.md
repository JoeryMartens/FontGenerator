# Font Loader
Basic code to load webfonts automatically into your CSS file. This is a basic PHP code which you can use to load your webfonts but it's also possible to edit the code and create your own extensions. The fontloader/generator can save time when you want to declare the path to all your different webfont files. You only have to include one file (run it once) and the fonts will be automatically added to your CSS.

# How it works

Webfont_declaration.php

This file will generate the CSS code. You have to put this file in the same directory as your font directory. 

```
$fonts = Array();
foreach (glob("fonts/*") as $filePath) {
	$part = explode('/', $filePath);
    $filename = end($part);
    $details = explode('.', $filename);
    $fonts[$details[0]][] = $details[1];
}
```

The code above search to all the fontsfiles in your fontdirectory and writes the filepath and filename in and object.  



