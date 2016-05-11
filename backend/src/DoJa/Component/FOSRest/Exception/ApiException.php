<?php

namespace DoJa\Component\FOSRest\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiException extends \Exception implements HttpExceptionInterface
{
    const INVALID_PARAMETERS = 'invalid_parameters';
    const BAD_REQUEST = 'bad_request';
    const UNAUTHORIZED = 'unauthorized';
    const FORBIDDEN = 'forbidden';
    const NOT_FOUND = 'not_found';
    const HTTP_METHOD_NOT_ALLOWED = 'method_not_allowed';

    private $errorCodesMap = [
        self::INVALID_PARAMETERS => 400,
        self::BAD_REQUEST => 400,
        self::UNAUTHORIZED => 401,
        self::FORBIDDEN => 403,
        self::NOT_FOUND => 404,
        self::HTTP_METHOD_NOT_ALLOWED => 405,
    ];
    private $errorCode;

    /**
     * @param string $errorCode
     * @param string $message
     * @param \Exception|null $previous
     */
    public function __construct($errorCode, $message = "", \Exception $previous = null)
    {
        parent::__construct($message, $this->errorCodesMap[$errorCode], $previous);

        $this->errorCode = $errorCode;
    }

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Returns the status code.
     *
     * @return int An HTTP response status code
     */
    public function getStatusCode()
    {
        return $this->getCode();
    }

    /**
     * Returns response headers.
     *
     * @return array Response headers
     */
    public function getHeaders()
    {
        return [];
    }
}
