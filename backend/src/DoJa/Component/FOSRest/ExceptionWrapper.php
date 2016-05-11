<?php

namespace DoJa\Component\FOSRest;

class ExceptionWrapper
{
    private $code;
    private $errorCode;
    private $message;
    private $errors;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->code = $data['status_code'];
        $this->errorCode = $data['status_text'];

        if (strlen($data['message']) > 0) {
            $this->message = $data['message'];
        }


        if (isset($data['errors'])) {
            $this->errors = $data['errors'];
        }
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
