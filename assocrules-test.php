<?php
    $item = file('item.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
    $belian = file('belian.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

    $item1 = count($item) - 1; // minus 1 from count
    $item2 = count($item);

    // MENDAPATKAN JUMLAH BARANG
    foreach ($item as $value) {
        $total_per_item[$value] = 0;
        foreach($belian as $item_belian) {            
            if(strpos($item_belian, $value) !== false) {
                $total_per_item[$value]++;
            }
        }
    }

    // MENDAPAT JUMLAH GABUNGAN
    for($i = 0; $i < $item1; $i++) {
        for($j = $i+1; $j < $item2; $j++) {
            $item_pair = $item[$i].'-'.$item[$j]; 
            $item_array[$item_pair] = 0;
            foreach($belian as $item_belian) {
                if((strpos($item_belian, $item[$i]) !== false) && (strpos($item_belian, $item[$j]) !== false)) {
                    $item_array[$item_pair]++;
                }
            }
        }
    }

    echo "<pre>";
    echo "\r\nStep 1: Jumlah Mengikut Item\r\n";
    print_r($total_per_item);
    echo "\r\nStep 2: Jumlah Gabungan Item\r\n";
    print_r($item_array);
    echo "\r\nStep 3: Association Rule\r\n";
    // MENDAPATKAN KIRAAN UNTUK ASSOCIATION RULES
    foreach ($item_array as $ia_key => $ia_value) {
        $theitems = explode('-',$ia_key);
        for($x = 0; $x < count($theitems); $x++) {
            $item_name = $theitems[$x];
            $item_total = $total_per_item[$item_name];
            $in_float = $ia_value / $item_total;
            $in_percent = round($in_float * 100, 2);
            $alt_item = $theitems[ ($x + 1) % count($theitems)];
            echo "[+] $ia_key($ia_value) --> $item_name($item_total) => ". $in_float ."\r\n";
            echo "    ". $in_percent ."% yang membeli $item_name juga membeli $alt_item\r\n\r\n";
        }
    }

    echo "\r\nSenarai Item\r\n";
    print_r($item);
    echo "\r\nSenarai Belian\r\n";
    print_r($belian);
    echo "</pre>";
?>