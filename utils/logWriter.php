<?php
function logger($file, $line, $sessionID,$string)
{

        $filename = "/var/www/log/Execution.log";
        $file = fopen($filename,"a");

        if (!$file)
        {
                echo "Something went wrong...!!!!";
        }
        $logTime = date("Y/m/d-H.i.s");
        fwrite($file,$logTime);
        fwrite($file, "|");
        fwrite($file, $file."|");
        fwrite($file, $line."|");
        fwrite($file, $sessionID);
        fwrite($file,"->>");
        fwrite($file, $string);
        fwrite($file, "\r\n");

        fclose($file);
        $logTime = date("Y/m/d-H.i.s");
//      error_log($logTime."->>".$string."\r\n",3,"Execution.log");
}

if(isset($_REQUEST["logclear"])){
        echo $_COOKIE['userId'];
if(isset($_COOKIE['userId']) && $_COOKIE['userId']=="0"){
        $filename = "Execution.log";
        $logTime = date("Y/m/d-H.i.s");
        //fwrite($file,$logTime);
        //fwrite($file,"->>");
        file_put_contents($filename, $logTime."->> Log cleared by user id ".$_COOKIE['userId']."\r\n");
        echo "Log cleared";
}else{
        echo $_COOKIE['userId'];
        echo "You dont have permission to clear log. :(";
}
}

else if(isset($_REQUEST["show"])){
if(isset($_COOKIE['userId']) && $_COOKIE['userId']=="0"){
        $filename = "Execution.log";
        $logTime = date("Y/m/d-H.i.s");
        //fwrite($file,$logTime);
        //fwrite($file,"->>");
        echo file_get_contents($filename);
}else{
        echo "You dont have permission to clear log.";
}
}
?>

