<?php
namespace Pre\Core\Fingerprint;

class FingerPrintProvider implements FingerPrint{
    private $params;

    public function __construct(array $params){
        $this->params = $params;
    }

    public function provideFingerPrint():string{
        $userAgent  = filter_var($this->params["HTTP_USER_AGENT"] ?? "",FILTER_SANITIZE_STRING);
        $ipAddres   = filter_var($this->params["REMOTE_ADDR"] ?? "",FILTER_SANITIZE_STRING);

        $result     = $userAgent . "@" . $ipAddres;
        $resultHash = hash("sha512", $result);
        return hash("sha512", $resultHash);
    }
}