<?php

return [
    Pre\Core\Router::get("|^login/?$|",                  "Login",            "show"),
    Pre\Core\Router::post("|^login/?$|",                 "Login",           "login"),
    Pre\Core\Router::get("|^registration/?$|",           "Registration",     "show"),
    Pre\Core\Router::post("|^registration/?$|",          "Registration",     "rgistration"),

    Pre\Core\Router::get("|^material/?$|",               "Material",         "show"),
    Pre\Core\Router::get("|^material/([1-9][0-9]+)$|",   "MaterialPanel",    "show"),
    Pre\Core\Router::post("|^material/?$|",              "Material",         "record"),
    Pre\Core\Router::get("|^publishing/?$|",             "Publishing",       "show"),

    Pre\Core\Router::get("|^useracount/([0-9]+)$|",      "User" ,            "show"),


    Pre\Core\Router::get("|^.*$|",                       "Main" ,            "home")
];