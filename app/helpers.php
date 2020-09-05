<?php
use App\Services\UtilityServices;
/**
 * get status
 *
 * @param int $status_id
 * @return string
 */

function setStatus($status_id = ''){
    if ($status_id == 0) {
        $status = '<span class="m-badge m-badge--danger">Inactive</span>';
    } else if($status_id == 1) {
        $status = '<span class="m-badge m-badge--success">Active</span>';
    } else {
        $status = '';
    }

    return $status;
}


/**
 * Set message
 *
 * @param string $type
 * @param string $label
 * @return string
 */

function setMessage($type, $label = '')
{
    $label = ucfirst(strtolower($label));

    if(strtolower($type)=='create') {
        $msg = $label." has been created successfully";
    } elseif(strtolower($type)=='update') {
        $msg = $label." has been updated successfully";
    } elseif(strtolower($type)=='delete') {
        $msg = $label." has been deleted successfully";
    } elseif(strtolower($type)=='create.error') {
        $msg = "Error in saving ".$label;
    }elseif(strtolower($type)=='update.error') {
        $msg = "Error in updating ".$label;
    } else {
        $msg = '';
    }
    return $msg;
}

function getStatus($status_id){
    if ($status_id == 1 ){
        $status = '<span class="m-badge m-badge--success">Status : Active</span>';
    }elseif ($status_id == 2){
        $status = '<span class="m-badge m-badge--warning">Status : Warning</span>';
    }elseif ($status_id == 0){
        $status = '<span class="m-badge m-badge--danger">Status : Inactive</span>';
    }else{
        $status = '';
    }
    return $status;
}

function setGender($gender_id){
    if ($gender_id == 1 ){
        $gender = 'Male';
    }elseif ($gender_id == 2){
        $gender = 'Female';
    }elseif ($gender_id == 0){
        $gender = 'Other';
    }else{
        $gender = '';
    }
    return $gender;
}

function checkExist($value){
    if ($value){
        $value = $value;
    }else{
        $value = 'N/A';
    }
    return $value;
}


function checkEmpty($value){

    return isset($value) ? (!empty($value) ? $value : null) : null;
}


