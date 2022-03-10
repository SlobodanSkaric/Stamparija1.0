<?php
namespace Pre\Core\Fingerprint;

class FingerProviderFactory{
    public function getFingInstance(string $params):FingerPrintProvider{
        switch($params){
            case $params = "SERVER";
                return new FingerPrintProvider($_SERVER);
        }

        return null;
    }
}