<?php
require '.env';

function encryptURL($envEncryptKey, $envEncryptIV, $groupID)
{
    $token = "valid";
    $EncryptKey = $envEncryptKey;
    $EncryptMethod = "AES-128-CTR";
    $EncryptIV = $envEncryptIV;
    $EncryptOptions = 0;
    $EncryptSeperater = ",";
    $a = array($groupID, $token);
    $imploded = implode($EncryptSeperater, $a);
    $b = openssl_encrypt($imploded, $EncryptMethod, $EncryptKey, $EncryptOptions, $EncryptIV);
    return $b;
}

function decryptURL($envEncryptKey, $envEncryptIV, $str)
{
    $DecryptKey = $envEncryptKey;
    $DecryptMethod = "AES-128-CTR";
    $DecryptIV = $envEncryptIV;
    $DecryptOptions = 0;
    $DecryptSeperater = ",";
    $d = openssl_decrypt($str, $DecryptMethod, $DecryptKey, $DecryptOptions, $DecryptIV);
    $exploded = explode($DecryptSeperater, $d);
    return $exploded;
}
function encryptPasswordURL($userID)
{
    $token = "valid";
    $EncryptKey = "ThisLeagueIsRunByJohn";
    $EncryptMethod = "AES-128-CTR";
    $EncryptIV = 1891600158911301;
    $EncryptOptions = 0;
    $EncryptSeperater = ",";
    $a = array($userID, $token);
    $imploded = implode($EncryptSeperater, $a);
    $b = openssl_encrypt($imploded, $EncryptMethod, $EncryptKey, $EncryptOptions, $EncryptIV);
    return $b;
}

function decryptPasswordURL($str)
{
    $DecryptKey = "ThisLeagueIsRunByJohn";
    $DecryptMethod = "AES-128-CTR";
    $DecryptIV = 1891600158911301;
    $DecryptOptions = 0;
    $DecryptSeperater = ",";
    $d = openssl_decrypt($str, $DecryptMethod, $DecryptKey, $DecryptOptions, $DecryptIV);
    $exploded = explode($DecryptSeperater, $d);
    return $exploded;
}

?>