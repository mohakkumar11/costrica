<?php

// get current directory
$current_directroy = getcwd();
echo "<pre>";

function scan_files($start) {

    # scan for files and folder 
    $contents = scandir($start);

    #remove . and .. from the $contents array
    array_splice($contents, 0,2);
    echo "<ul>";
    foreach ( $contents as $item ) {

        // check if it is directroy 
        if ( is_dir("$start/$item")  ) 
        {
            echo "<li><b>$item</b></li>";

            // call the function for recursive search
            scan_files("$start/$item");
        } 

        // if it is not a directory
        else 
        {
            echo "<li>$item</li>";
        }
    }
    echo "</ul>";
}

scan_files($current_directroy);
