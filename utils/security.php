<?php
        require 'DBManager.php';
        require 'logWriter.php';

        function validate_session(&$sessid, &$userId){
/*
                if (!isset($_REQUEST['sessid'])){
                        $response = array(
                                "code" => "0",
                                "description" => "No session id found"
                        );
                        die(json_encode($response));
                }
*/

                if (!isset($_REQUEST['sessid'])){
                        if (session_id() == "")
                                session_start();
                        $sessid = session_id();
                }
                else
                        $sessid = $_REQUEST['sessid'];

                getConnection();

                $query = "SELECT user FROM session WHERE id = '".$sessid."'";
                logger(__FILE__, __LINE__, $sessid, $query);
                executeSQLReturn($query, $num_rows, $num_fields, $val, $cols);
                if ($num_rows == 0){
                        return 1;
                }
                $userId = $val[0][0];
                //logger(__FILE__,__LINE__,0, "UserId for current session ->> ".$userId);

                return 0;
        }

        function create_session($id, &$userId){
                getConnection();

                $query = "INSERT INTO session (id, user ) VALUES ('".$id."', '".$userId."')";
                //$query = "INSERT INTO session (id, status) VALUES ('".$id."','AC')";
                //logger(__FILE__,__LINE__,0, $query);
                $status = executeSQL($query);
                if ($status < 0){
                        //logger(__FILE__,__LINE__,0,'Error creating session');
                        return 1;
                }
                logger(__FILE__,__LINE__,0,'Session created');
                return 0;
        }

        function destroy_session($id){
                getConnection();

                $query = "DELETE FROM session WHERE id = '".$id."'";
                $status = executeSQL($query);
                if ($status < 0){
                        logger(__FILE__,__LINE__,0, 'Error destroying session');
                        return 1;
                }
                logger (0, 'Session Destroyed');
                return 0;
        }

        function header_exit($code, $msg){
                header("HTTP/1.0 ".$code." ".$msg);
                header("ResponseMsg: ".$msg);
                logger(__FILE__,__LINE__,0, $msg);
        }
?>

