<?php
/**
 * Function make formal date
 */
function format_date($date)
{
    return date("d M Y", strtotime($date));
}

/**
 * Function make formal date for input
 */
function format_date_for_input($date)
{
    return date("Y-m-d", strtotime($date));
}

/**
 * Making base 64 encode
 */
function make_base_64($array)
{
    $json = json_encode($array);
    return base64_encode($json);
}

/**
 * Check jumlah inputan qty dan uang tunai
 * Jika terisi pada form maka function di bawah ini akan bernilai true sehingga dapat disimpan dalam table
 */
function check_form_input_qty($qty_input, $uang_tunai='')
{
    $count = 0;

    // Check form input qty rewards
    if(!empty($qty_input)):
        foreach($qty_input as $key => $qty):
            foreach($qty as $product_id => $d):
                if(!empty($d)):
                    $count+=1;
                endif;
            endforeach;
        endforeach;
    endif;

    // Check form input uang tunai
    if(!empty($uang_tunai)):
        foreach($uang_tunai as $d):
            if(!empty($d)):
                $count+=1;
            endif;
        endforeach;
    endif;

    return $count;
}


/**
 * Check jumlah inputan qty
 */
function check_form_input_qty_taking_goods($qty_input)
{
    $count = 0;

    if(!empty($qty_input)):
        foreach($qty_input as $key => $d):
            if(!empty($d[0])):
                $count+=1;
            endif;
        endforeach;
    endif;
    
    return $count;
}


/* 
* days_in_month($month, $year) 
* Returns the number of days in a given month and year, taking into account leap years. 
* 
* $month: numeric month (integers 1-12) 
* $year: numeric year (any integer) 
* 
* Prec: $month is an integer between 1 and 12, inclusive, and $year is an integer. 
* Post: none 
*/ 
// corrected by ben at sparkyb dot net 
function days_in_month($month, $year) 
{ 
    // calculate number of days in a month 
    return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 
}

function get_label_chart($filter, $month='', $year='', $start='', $end='')
{
    $label_chart = array();

    if($filter == "bulan"):
        $label_chart = array();
        for($monthNum=1; $monthNum<=12; $monthNum++):
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('M');
            array_push($label_chart, $monthName);
        endfor;
    elseif($filter == "hari"):
        $days_in_month = days_in_month($month, $year);

        for($day=1; $day<=$days_in_month; $day++):
            array_push($label_chart, $day);
        endfor;
    elseif($filter == "tahun"):
        for($i=$start; $i<=$end; $i++):
            array_push($label_chart, $i);
        endfor;
    endif;

    return $label_chart;
}

function get_count_qty_days($data_array, $month, $year)
{
    $days_in_month = days_in_month($month, $year);

    $new_data_days = array();
    foreach($data_array as $d):
        if(isset($d[$month])):
            $new_data_days[] = $d[$month];
        endif;
    endforeach;
    
    $final_days = array();
    array_walk_recursive($new_data_days, function($item, $key) use (&$final_days){
        $final_days[$key] = isset($final_days[$key]) ?  $item + $final_days[$key] : $item;
    });

    $days_sales = [];
    for($i=1; $i<=$days_in_month; $i++):
        $key = $i-1;
        $val = isset($final_days[$i]) ? $final_days[$i] : 0;
        array_push($days_sales, $val);
    endfor;

    return $days_sales;
}


function get_count_qty_month($data_array)
{
    // Datas Month
    $final_datas = array();
    array_walk_recursive($data_array, function($item, $key) use (&$final_datas){
        $final_datas[$key] = isset($final_datas[$key]) ?  $item + $final_datas[$key] : $item;
    });

    $sales = [];
    for($i=1; $i<=12; $i++):
        $val = isset($final_datas[$i]) ? $final_datas[$i] : 0;
        array_push($sales, $val);
    endfor;

    return $sales;
}

function get_count_qty_year($data_array, $start, $end)
{
    // Datas Year
    $final_datas = array();
    array_walk_recursive($data_array, function($item, $key) use (&$final_datas){
        $final_datas[$key] = isset($final_datas[$key]) ?  $item + $final_datas[$key] : $item;
    });

    $sales = [];
    for($i=$start; $i<=$end; $i++):
        $val = isset($final_datas[$i]) ? $final_datas[$i] : 0;
        array_push($sales, $val);
    endfor;

    return $sales;
}

function get_month_name_indonesia($monthNum)
{
    switch($monthNum){
        case 1:
            $month_text = "Januari";
            break;
        case 2:
            $month_text = "Pebruari";
            break;
        case 3:
            $month_text = "Maret";
            break;
        case 4:
            $month_text = "April";
            break;
        case 5:
            $month_text = "Mei";
            break;
        case 6:
            $month_text = "Juni";
            break;
        case 7:
            $month_text = "Juli";
            break;
        case 8:
            $month_text = "Agustus";
            break;
        case 9:
            $month_text = "September";
            break;
        case 10:
            $month_text = "Oktober";
            break;
        case 11:
            $month_text = "Nopember";
            break;
        case 12:
            $month_text = "Desember";
            break;
    }
    return $month_text;
}


function status_indonesia( $data ) {
    if( $data == "Active" ):
        return "Aktif";
    else:
        return "Tidak Aktif";
    endif;
}
?>