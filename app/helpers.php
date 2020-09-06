<?php
use App\Services\UtilityServices;
use Carbon\Carbon;

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

function calculateAgeByBirthDate($birthDate){
    if ($birthDate){
       return Carbon::createFromDate($birthDate)->age;
    }
}

function checkEmpty($value){
    return isset($value) ? (!empty($value) ? $value : null) : null;
}

function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius){
    // convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $lonDelta = $lonTo - $lonFrom;
    $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
    $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

    $angle = atan2(sqrt($a), $b);
    return $angle * $earthRadius;
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}


