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
    const SESSION_TIME           = 2100;
}