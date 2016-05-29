<?php
        require 'utils/DBManager.php';
        require 'utils/logWriter.php';
        require 'utils/exits.php';
/*
        if (!isset($_REQUEST['lat1']) || !isset($_REQUEST['lon1']) ||
                !isset($_REQUEST['lat2']) || !isset($_REQUEST['lon2'])){
                logger(__FILE__, __LINE__, 0, "Incorrect Parameters specified");
                //exitError("Incorrect Parameters specified");
                exitError("Incorrect Parameters specified");
        }
        $lat1 = addslashes($_REQUEST['lat1']);
        $lon1 = addslashes($_REQUEST['lon1']);
        $lat2 = addslashes($_REQUEST['lat2']);
        $lon2 = addslashes($_REQUEST['lon2']);
*/
/*
        $dist = 0.5;
        $rlon1 = $lon-$dist/abs(cos(deg2rad($lat))*69);
        $rlon2 = $lon+$dist/abs(cos(deg2rad($lat))*69);
        $rlat1 = $lat-($dist/69);
        $rlat2 = $lat+($dist/69);
*/
        $query = "SELECT name, description, url, thumbnail, user, likes, views, latitude, longitude, timestamp, id
                        FROM image";
        logger(__FILE__, __LINE__, 0, $query);

        executeSQLReturn($query, $num_rows, $num_fields, $val, $cols);
        $data="";
        if ($num_rows == 0){
                logger(__FILE__, __LINE__, 0, "No images availables");
                exitWithZeroCount("No images available");
        }
        else {
                for ($row = 0; $row < $num_rows; $row++) {
                        $data[$row] = array('id' => $val[$row][10],
					'name' => $val[$row][0],
                                        'description' => $val[$row][1],
                                        'url' => $val[$row][2],
                                        'thumbnail' => $val[$row][3],
                                        'user' => $val[$row][4],
                                        'likes' => $val[$row][5],
                                        'views' => $val[$row][6],
                                        'latitude' => $val[$row][7],
                                        'longitude' => $val[$row][8],
                                        'timestamp' => $val[$row][9]);
                }
                exitWithData($data);
        }
?>

