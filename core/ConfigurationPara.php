<?php
namespace Pre\Core;

class ConfigurationPara{
    const HOSTNAME = "localhost";
    const USERNAME = "press";
    const PASSWORD = "pressroom";
    const DBNAME   = "pressroom";
    const CHARSET  = "utf8";

    const SESSION_CLASS_INSTANCE = "Pre\\Core\\Session\\FileSession";
    const SESSION_PATH           = ["./session/"];
    const SESSION_TIME           = 60*60*8;

    //const FINGER_PRINT_PROVIDER         = "Pre\\Core\\Fingerprint\\FingerPrintProvider";
    const FINGER_PRINT_PDOVIDER_FACTORY = "Pre\\Core\\Fingerprint\\FingerProviderFactory";
    const FINGER_PRINT_METHOD           = "getFingInstance";
    const FINGER_PRINT_PARAMETER        = "SERVER";
}