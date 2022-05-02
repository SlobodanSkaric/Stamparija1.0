<?php

return [        
    Pre\Core\Router::get("|^login/?$|",                         "Login",            "show"),
    Pre\Core\Router::post("|^login/?$|",                        "Login",            "login"),
    Pre\Core\Router::get("|^registration/?$|",                  "Registration",     "show"),
    Pre\Core\Router::post("|^registration/?$|",                 "Registration",     "rgistration"),

    Pre\Core\Router::get("|^material/?$|",                      "Material",         "show"),
    Pre\Core\Router::get("|^material/([1-9][0-9]+)$|",          "MaterialPanel",    "show"),
    Pre\Core\Router::post("|^material/?$|",                     "Material",         "record"),
    Pre\Core\Router::get("|^publishing/?$|",                    "Publishing",       "show"),
    Pre\Core\Router::post("|^publishing/?$|",                   "Publishing",       "pub"),
    Pre\Core\Router::get("|^note/?$|",                          "Note",             "show"),
    Pre\Core\Router::post("|^note/?$|",                         "Note",             "postNote"),
    Pre\Core\Router::get("|^message/?$|",                       "Note",             "unrideNote"),

    Pre\Core\Router::get("|^useracount/([0-9]+)$|",             "User" ,            "show"),

    #ApiRoute
    Pre\Core\Router::get("|^api/search/([0-9]+)$|",             "ApiSearch",        "search"),
    Pre\Core\Router::get("|^api/message/?$|",                   "ApiMessage",       "unrideNotes"),
    Pre\Core\Router::get("|^api/message/update/([0-9]+)$|",     "ApiMessageUpdate", "updateNote"),



    Pre\Core\Router::get("|^.*$|",                               "Main" ,            "home")
];