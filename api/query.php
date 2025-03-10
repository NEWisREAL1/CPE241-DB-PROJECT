<?php
// header("Content-Type: application/json");
include '../db.php';
session_start();
// if(isset($_SERVER["HTTP_REFERER"]) && isset($_SESSION['admin'])){
    // --- QUERY FOR TRAFFIC CHOROPLETH MAP
    if(isset($_GET["query_table"])){
        $query_table = $_GET["query_table"];
        if(isset($_GET["query_column"])){
            $statement = "select * from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$CONFIG["DB_NAME"]."' AND TABLE_NAME='".$query_table."'";
            $stmt = $conn->prepare($statement);
            $stmt->execute();
            $columnResults = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach($columnResults as $key => $value){
                $columnResults[$key] = array(
                    "name" => $value["COLUMN_NAME"],
                    "pkey" => $value["COLUMN_KEY"] == "PRI" ? true : false
                );
            }
            echo json_encode($columnResults);
            die();
        }
        $statement = "select * from INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$CONFIG["DB_NAME"]."' AND TABLE_NAME='".$query_table."'";
        $stmt = $conn->prepare($statement);
        $stmt->execute();
        $columnResults = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        //loop $columnsResults and get only COLUMN_NAME columns
        foreach($columnResults as $key => $value){
            $columnResults[$key] = $value["COLUMN_NAME"];
        }
        $requestData= $_REQUEST;
        // remove request_data qurery_table
        unset($requestData["query_table"]);
        // print(json_encode($columnResults));
        //Join $columnResults with ,
        $columns = implode(",",$columnResults);
        $sql = "SELECT ".$columns." FROM ".$query_table;
        $result = $conn->query($sql);
        $totalData = $conn->affected_rows;
        $totalFiltered = $totalData;
        $sql = "SELECT ".$columns." FROM ".$query_table;
        if(!empty($requestData['search']['value'])) {
            $sql.=" WHERE (";
            for($i=0 ; $i<count($columnResults); $i++){
                $sql.=" `".$columnResults[$i]."` LIKE '".$requestData['search']['value']."%' OR";
            }
            $sql = substr($sql, 0, -2);
            $sql.=" )";
        }
        $result = $conn->query($sql);
        $totalFiltered = $conn->affected_rows;
        $sql.=" ORDER BY ".$columnResults[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".
            $requestData['start']." ,".$requestData['length']."   ";

        
        $result = $conn->query($sql);
        $data = array();
        while( $row = $result->fetch_assoc() ) {  // preparing an array
            $nestedData = array();
            foreach($columnResults as $column){
                $nestedData[$column] = $row[$column];
            }
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data,   // total data array,
            "sql"             => $sql
        );
        echo json_encode($json_data);
        die();
        
    }else{
        die(json_encode(array("error" => "No query table.")));
    }


    //Terminate connection of mysql
    $conn->close();

// }else{
//     //Terminate connection of mysql
//     $conn->close();
//     //Prevention to access api/query.php directly
//     header("HTTP/1.1 403 Forbidden");
//     die("You are not allowed to access this page directly.");
// }