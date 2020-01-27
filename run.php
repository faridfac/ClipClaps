<?php
$uuid = gen_uuid();

echo 'Input Country Code (Ex: 1 / 62) : ';
$areaCode = trim(fgets(STDIN));
echo "Input Phone Number : ";
$no = trim(fgets(STDIN));

$otp = file_get_contents('http://faridfac.herokuapp.com/clipclaps/otp.php?no='.$no.'&id='.$uuid.'&areacode='.$areaCode)."\n";

if(preg_match('/Success/i', $otp)){
    echo 'Input OTP Code : ';
    $otpSMS = trim(fgets(STDIN));
    echo 'Input Refferal Code : ';
    $reff = trim(fgets(STDIN));

    $redeem = file_get_contents('http://faridfac.herokuapp.com/clipclaps/redeem.php?no='.$no.'&otp='.$otpSMS.'&uuid='.$uuid.'&areacode='.$areaCode.'&reff='.$reff)."\n";
    echo $redeem;
} else if (preg_match('/Server is busy, please try again later./i', $otp)){
    echo "Server is busy, please try again later.";
    exit;
} else {
    echo "$otp \n";
    exit;
}
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
?>
