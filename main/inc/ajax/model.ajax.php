<?php
$action = $_GET['a'];

require_once '../global.inc.php';
$libpath = api_get_path(LIBRARY_PATH);
$table = '';

// 1. Setting variables

//Variables needed by jqgrid

$page  = intval($_REQUEST['page']); //page
$limit = intval($_REQUEST['rows']); // quantity of rows
$sidx  = intval($_REQUEST['sidx']); //index to filter         
$sord  = $_REQUEST['sord'];         //asc or desc
if (!in_array($sord, array('asc','desc'))) {
    $sord = 'desc';
}
// get index row - i.e. user click to sort $sord = $_GET['sord']; 
// get the direction 
if(!$sidx) $sidx = 1;
 
 
//2. Selecting the count
switch ($action) {
    case 'get_careers':        
        require_once $libpath.'career.lib.php';
        $obj        = new Career();
        $count      = $obj->get_count();
    break;
    case 'get_promotions':
       require_once $libpath.'promotion.lib.php';        
        $obj        = new Promotion();        
        $count      = $obj->get_count();   
    break;
    default:
        exit;   
}
        
if( $count >0 ) { 
    $total_pages = ceil($count/$limit); 
} else { 
    $total_pages = 0; 
}

if ($page > $total_pages) { 
    $page = $total_pages;
}     
$start = $limit * $page - $limit; 

//2. Querying the DB
switch ($action) {
    case 'get_careers':
        if ($_REQUEST['oper'] == 'del') {
            $obj->delete($_REQUEST['id']);
        }
        $columns    = $obj->columns;
        $columns[]  = 'actions';        
        $result     = Database::select('*', $obj->table, array('order'=>"$sidx $sord", 'LIMIT'=> "$start , $limit"));
    break;
    case 'get_promotions':
        if ($_REQUEST['oper'] == 'del') {
        	$obj->delete($_REQUEST['id']);
        }
        $columns    = $obj->columns;
        $columns[]  = 'career';
        $columns[]  = 'actions';                
        $result     = Database::select('p.id, p.name, p.description, c.name as career', "$obj->table p LEFT JOIN ".Database::get_main_table(TABLE_CAREER)." c  ON c.id = p.career_id ", array('order' =>"$sidx $sord", 'LIMIT'=> "$start , $limit"));       
    break;
    default:
        exit;            
}

if (in_array($action, array('get_careers','get_promotions'))) {
    //3. Creating an obj return a json
    $responce = new stdClass();           
    $responce->page     = $page; 
    $responce->total    = $total_pages; 
    $responce->records  = $count; 
    $i=0;
    if (!empty($result)) {
        foreach($result as $row) {
             //print_r($row);
             $responce->rows[$i]['id']=$row['id'];
             $array = array();
             foreach($columns as $col) {
             	$array[] = $row[$col];
             }                   
             $responce->rows[$i]['cell']=$array;
             $i++; 
        }
    } 
    echo json_encode($responce);       
}
exit;