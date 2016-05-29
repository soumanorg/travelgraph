<?php

        function exitWithData ($data) {
                $out = array ('response' => 0,
                                'count' => count($data),
                                'data' => $data);
                echo json_encode($out);
                exit;
        }

        function exitError($msg) {
                $out = array ('response' => 1,
                                'message' => $msg);
                echo json_encode($out);
                exit;
        }

        function exitSuccess($msg) {
                $out = array ('response' => 0,
                                'message' => $msg);
                echo json_encode($out);
                exit;
        }

        function exitWithVal($msg) {
                $out = array ('response' => 0,
                                'value' => $msg);
                echo json_encode($out);
                exit;
        }

        function exitWithZeroCount($msg) {
                $out = array ('response' => 0,
                                'count' => 0,
                                'msg' => $msg);
                echo json_encode($out);
                exit;
        }
?>

