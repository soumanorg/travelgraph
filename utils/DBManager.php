<?php

//class ConnectionManager
//{

        function getConnection()
        {
                require 'config/DBconfig.php';

                $conn = mysqli_connect($dbhost ,$dbuser, $dbpass, $dbname);
                //printf("This is a new connection; Connection successful\n");
                if(mysqli_connect_errno($conn))
                        die( "Error connecting to DB " . mysqli_connect_error());
                else
                        return $conn;
        }

        function releaseConnection()
        {
                mysql_close($conn);
        }
//}

//class QueryManager
//{
        function executeSQL($query)
        {
                $conn = getConnection();
                //First execute the query.
                $result = mysqli_query($conn, $query);

                //check the status of query execution.
                if (!$result)
                {
                        echo "Error executing query " + $query + "\n";
                        echo "Error details =>> " + mysqli_error();
                        return mysqli_affected_rows($conn);
                }
                else
                {
                        //printf("Query executed successfully\n");
                        $val = mysqli_affected_rows($conn);
                        mysqli_close($conn);
                        return($val);
                }

        }

        function executeInsert($query)
        {
                $conn = getConnection();
                //First execute the query.
                $result = mysqli_query($conn, $query);

                //check the status of query execution.
                if (!$result)
                {
                        echo "Error executing query " + $query + "\n";
                        echo "Error details =>> " + mysqli_error();
                        return mysqli_affected_rows($conn);
                }
                else
                {
                        //printf("Query executed successfully\n");
                        return mysqli_insert_id($conn);
                }

        }

        function executeMultiSQL($query)
        {
                $conn = getConnection();
                //First execute the query.
                $result = mysqli_multi_query($conn, $query);

                //check the status of query execution.
                if (!$result)
                {
                        echo "Error executing query " + $query + "\n";
                        echo "Error details =>> " + mysqli_error();
                        return mysqli_affected_rows($conn);
                }
                else
                {
                        //printf("Query executed successfully\n");
                        return mysqli_affected_rows($conn);
                }
                mysqli_close($conn);

        }

        function executeSQLReturn($query, &$num_rows, &$num_fields, &$val ,&$cols)
        {
                $conn = getConnection();
                //First execute the query.
                $result = mysqli_query($conn, $query);
                $i=0;
                while($p = mysqli_fetch_field($result))
                        $cols[$i++]=$p->name;

                //Buffer the result
                mysqli_store_result($conn);

                if(mysqli_num_rows($result)!=0)
                {
                        //Get the number of fields
                        $num_fields = mysqli_num_fields($result);
                        $num_rows = mysqli_num_rows($result);
                        for($i=0;$i<$num_rows;$i++)
                        {
                                $temp = mysqli_fetch_array($result, MYSQL_BOTH);
                                for($j=0;$j<$num_fields;$j++)
                                {
                                        $val[$i][$j]=$temp[$j];
                                }
                        }
                }
                else
                {
                        $num_fields = 0;
                        $num_rows = 0;
                }
        }

//}
?>

