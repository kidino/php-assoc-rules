<?php
    $item = file('item.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    $belian = file('belian.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

    $item_loop = (pow($item1,2) + $item1) / 2; // triangular number

    $item_array = array();

    foreach ($item as $value) {
        $total_per_item[$value] = 0;
        foreach($belian as $item_belian) {            
            if(strpos($item_belian, $value) !== false) {
                $total_per_item[$value]++;
            }
        }
    }

    echo "<pre>";
    echo "\r\nStep 1: Jumlah Mengikut Item\r\n";
    print_r($total_per_item);
    
    $item1 = count($item) - 1; // minus 1 from count
    $item2 = count($item); // minus 1 from count

    for($i = 0; $i < $item1; $i++) {
        for($j = $i+1; $j < $item2; $j++) {
            $item_array[$item[$i].'-'.$item[$j]] = 0;
            
            foreach($belian as $item_belian) {
                if((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
                    $item_array[$item[$i].'-'.$item[$j]]++;
                }
            }
        }
    }
    
    
    echo "\r\nStep 2: Jumlah Gabungan Item\r\n";
    print_r($item_array);

    echo "\r\nStep 3: Jumlah Gabungan Item\r\n";
    foreach ($item_array as $ia_key => $ia_value) {
        foreach ($total_per_item as $tpi_key => $tpi_value) {
            if ((strpos($ia_key, $tpi_key) !== false)) {
            echo "[+] $ia_key($ia_value) --> $tpi_key($tpi_value) => ".  $ia_value / $tpi_value ."\r\n";
            list($itemx, $itemy) = explode('-',$ia_key);
            if ($itemx == $tpi_key) { $theitem = $itemy; }
            else { $theitem = $itemx; }
            echo "    ". round($ia_value / $tpi_value * 100, 2)."% yang membeli $tpi_key juga membeli $theitem\r\n\r\n";
            }
        }
    }
    echo "</pre>"; exit();

    echo "\r\nSenarai Item\r\n";
    print_r($item);
    echo "\r\nSenarai Belian\r\n";
    print_r($belian);
    echo "</pre>";
?>