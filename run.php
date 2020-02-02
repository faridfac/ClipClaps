<?php
$uuid = gen_uuid();

// echo 'Input Country Code (Ex: 1 / 62) : ';
$areaCode = "1";
echo "Input Phone Number Tanpa 1 diawal\n";
echo "Input Phone Number (Ex: 315 / 250) : ";
$no = trim(fgets(STDIN));

$otp = file_get_contents('http://faridfac.herokuapp.com/clipclaps/otp.php?no='.$no.'&id='.$uuid.'&areacode='.$areaCode);

if(preg_match('/Success/i', $otp)){
    echo 'Input OTP Code : ';
    $otpSMS = trim(fgets(STDIN));
    echo 'Input Refferal Code : ';
    $reff = trim(fgets(STDIN));

    $redeem = file_get_contents('http://faridfac.herokuapp.com/clipclaps/redeem.php?no='.$no.'&otp='.$otpSMS.'&uuid='.$uuid.'&areacode='.$areaCode.'&reff='.$reff);
    echo $redeem;
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
