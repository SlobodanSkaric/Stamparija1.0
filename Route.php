<?php

return [
  
    Pre\Core\Router::get("|^useracount/([0-9]+)$|",    "User",             "show"),


    Pre\Core\Router::get("|^.*$|",                     "Main",             "home")
];