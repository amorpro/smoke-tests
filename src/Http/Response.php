<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 21:07
 */

namespace SmokeTests\Http;



use SmokeTests\Http\Behaviour\Cookies;
use SmokeTests\Http\Behaviour\Headers;
use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

class Response
{

    use Headers, Cookies;

    public const STATUS_OK    = 'ok';
    public const STATUS_ERROR = 'error';

    public const STATUSES = [
        self::STATUS_OK,
        self::STATUS_ERROR,
    ];
    private const HTTP_STATUSES = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing', // WebDAV; RFC 2518
        103 => 'Early Hints', // RFC 8297
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information', // since HTTP/1.1
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content', // RFC 7233
        207 => 'Multi-Status', // WebDAV; RFC 4918
        208 => 'Already Reported', // WebDAV; RFC 5842
        226 => 'IM Used', // RFC 3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // Previously "Moved temporarily"
        303 => 'See Other', // since HTTP/1.1
        304 => 'Not Modified', // RFC 7232
        305 => 'Use Proxy', // since HTTP/1.1
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect', // since HTTP/1.1
        308 => 'Permanent Redirect', // RFC 7538
        400 => 'Bad Request',
        401 => 'Unauthorized', // RFC 7235
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required', // RFC 7235
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed', // RFC 7232
        413 => 'Payload Too Large', // RFC 7231
        414 => 'URI Too Long', // RFC 7231
        415 => 'Unsupported Media Type', // RFC 7231
        416 => 'Range Not Satisfiable', // RFC 7233
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot', // RFC 2324, RFC 7168
        421 => 'Misdirected Request', // RFC 7540
        422 => 'Unprocessable Entity', // WebDAV; RFC 4918
        423 => 'Locked', // WebDAV; RFC 4918
        424 => 'Failed Dependency', // WebDAV; RFC 4918
        425 => 'Too Early', // RFC 8470
        426 => 'Upgrade Required',
        428 => 'Precondition Required', // RFC 6585
        429 => 'Too Many Requests', // RFC 6585
        431 => 'Request Header Fields Too Large', // RFC 6585
        451 => 'Unavailable For Legal Reasons', // RFC 7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates', // RFC 2295
        507 => 'Insufficient Storage', // WebDAV; RFC 4918
        508 => 'Loop Detected', // WebDAV; RFC 5842
        510 => 'Not Extended', // RFC 2774
        511 => 'Network Authentication Required', // RFC 6585
    ];

    private $body,
        $duration,
        $httpCode,
        $contentType,
        $status = self::STATUS_OK
    ;

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return $this
     */
    public function setBody($body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     * @return $this
     */
    public function setDuration($duration): self
    {
        $this->duration = (float)$duration;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHttpCode():int
    {
        return (int)$this->httpCode;
    }

    /**
     * @param mixed $httpCode
     * @return $this
     */
    public function setHttpCode($httpCode): self
    {
        Assert::inArray($httpCode, array_keys(self::HTTP_STATUSES));

        $this->httpCode = $httpCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     *
     * @throws InvalidArgumentException
     */
    public function setStatus(string $status): self
    {
        Assert::inArray($status, self::STATUSES);

        $this->status = $status;
        return $this;
    }

    public function isOk(): bool
    {
        return $this->status === self::STATUS_OK;
    }

    public function humanizeStatus(): string
    {
        return $this->isError() ? "Error" : 'OK';
    }

    /**
     * @return string
     */
    public function humanizeHttpCode(): string
    {
        return self::HTTP_STATUSES[$this->httpCode] ?? 'Unknown http code';
    }

    public function isError(): bool
    {
        return $this->status === self::STATUS_ERROR;
    }

    /**
     * @return array|bool
     */
    public function getJson()
    {
        return json_decode($this->body, true);
    }

    /**
     * @return ContentType
     */
    public function getContentType(): ContentType
    {
        return $this->contentType;
    }

    /**
     * @param mixed $contentType
     * @return $this
     */
    public function setContentType($contentType): Response
    {
        $this->contentType = new ContentType($contentType);
        return $this;
    }

}
