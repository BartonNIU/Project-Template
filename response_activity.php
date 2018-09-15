<?php
session_start();


include("mysql_connect.php");
//$rows = array();


$keyword_main = "";
$keyword = "";
$option = "";
$check_p = "";
$check_c = "";

if (isset($_SESSION['userinput'])){
    $keyword_main = $_SESSION['userinput'];
}

//if (isset($_SESSION['keyword_activity'])){
//    $keyword = $_SESSION['keyword_activity'];
//}
//if (isset($_SESSION['option_activity'])){
//    $option = $_SESSION['option_activity'];
//}

if (isset($_POST['userinput_activity'])){
    $keyword = $_POST['userinput_activity'];
}
if (isset($_POST['value'])){
    $option = $_POST['value'];
}
if (isset($_POST['check_p'])){
    $check_p = $_POST['check_p'];
}
if (isset($_POST['check_c'])){
    $check_c = $_POST['check_c'];
}

// check if the input has been passed successfully
//echo "keywordmain value is: ".$keyword_main."<br>";



//     sql query for the map markers
function queryResult($connect, $sql){
    $result = mysqli_query($connect, $sql);
    $rows = array();

    if (mysqli_num_rows($result) > 0) {
        // output data
        while($record = mysqli_fetch_assoc($result)) {

            $rows[]=$record;
            //echo json_encode($record);
        }
    }
    else {
        $rows = ["audience" => "","activity_title" => "","address" => "Melbourne","coordinates" => "{lat: -37.8136, lng: 144.9621}"];
        //echo "query no result";
    }
    echo json_encode ($rows);  //pass data to javascript for map markers
}


// check if the userinput on the listing page exist or not
if ($keyword != "" or $option != "") {
    $keyword_main = "";   // to avoid the influence from the index page input
    if ($option == "All Budget Ranges"){
        $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (post_code like '%$keyword%'or suburb like '%$keyword%')and (audience like '%$check_p%' and audience like '%$check_c%')";
        queryResult($connect, $sql);

    } elseif ($option == "Free") {
        $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (post_code like '%$keyword%'or suburb like '%$keyword%')and fee like '%$option%' and ( audience like '%$check_p%'and audience like '%$check_c%')";
        queryResult($connect, $sql);

    } elseif ($option == "less than $20") {
        $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (post_code like '%$keyword%'or suburb like '%$keyword%')and fee_fix <=20 and ( audience like '%$check_p%'and audience like '%$check_c%')";// like '%$option%'";
        queryResult($connect, $sql);


    } elseif ($option == "$20-$50") {
        $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (post_code like '%$keyword%'or suburb like '%$keyword%')and fee_fix >20 and fee_fix <=50 and ( audience like '%$check_p%'and audience like '%$check_c%')";// like '%$option%'";
        queryResult($connect, $sql);


    } elseif ($option == "$50-$100") {
        $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (post_code like '%$keyword%'or suburb like '%$keyword%') and fee_fix > 50 and fee_fix <=100 and (audience like '%$check_p%'and audience like '%$check_c%')";// like '%$option%'";
        queryResult($connect, $sql);

    } elseif ($option == "more than $100") {
        $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (post_code like '%$keyword%'or suburb like '%$keyword%') and fee_fix > 100 and (audience like '%$check_p%'and audience like '%$check_c%')";// like '%$option%'";
        queryResult($connect, $sql);

    } else {
        $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (post_code like '%$keyword%'or suburb like '%$keyword%') and (audience like '%$check_p%'and audience like '%$check_c%')"; //and description like '%$keyword%'";
        queryResult($connect, $sql);

    }
}else{
    $sql = "SELECT * FROM  activity where (post_code like '%$keyword_main%' or suburb like '%$keyword_main%')and (audience like '%$check_p%'and audience like '%$check_c%')"; //and description like '%$keyword%'";
    queryResult($connect, $sql);
}


//echo json_encode ($rows);
mysqli_close($connect);

