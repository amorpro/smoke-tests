<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 14.08.2021
 * Time: 16:50
 */

namespace SmokeTests\Http;

use Webmozart\Assert\Assert;

class ContentType
{
    private const MIME_TYPES = [
        'aac'    => 'audio/aac',
        'abw'    => 'application/x-abiword',
        'arc'    => 'application/x-freearc',
        'avi'    => 'video/x-msvideo',
        'azw'    => 'application/vnd.amazon.ebook',
        'bin'    => 'application/octet-stream',
        'bmp'    => 'image/bmp',
        'bz'     => 'application/x-bzip',
        'bz2'    => 'application/x-bzip2',
        'csh'    => 'application/x-csh',
        'css'    => 'text/css',
        'csv'    => 'text/csv',
        'doc'    => 'application/msword',
        'docx'   => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'eot'    => 'application/vnd.ms-fontobject',
        'epub'   => 'application/epub+zip',
        'gz'     => 'application/gzip',
        'gif'    => 'image/gif',
        'htm'    => 'text/html',
        'html'   => 'text/html',
        'ico'    => 'image/vnd.microsoft.icon',
        'ics'    => 'text/calendar',
        'jar'    => 'application/java-archive',
        'jpeg'   => 'image/jpeg',
        'jpg'    => 'image/jpeg',
        'js'     => 'text/javascript',
        'js-x'     => 'application/x-javascript',
        'json'   => 'application/json',
        'jsonld' => 'application/ld+json',
        'mid'    => 'audio/midi audio/x-midi',
        'midi'   => 'audio/midi audio/x-midi',
        'mjs'    => 'text/javascript',
        'mp3'    => 'audio/mpeg',
        'mpeg'   => 'video/mpeg',
        'mpkg'   => 'application/vnd.apple.installer+xml',
        'odp'    => 'application/vnd.oasis.opendocument.presentation',
        'ods'    => 'application/vnd.oasis.opendocument.spreadsheet',
        'odt'    => 'application/vnd.oasis.opendocument.text',
        'oga'    => 'audio/ogg',
        'ogv'    => 'video/ogg',
        'ogx'    => 'application/ogg',
        'opus'   => 'audio/opus',
        'otf'    => 'font/otf',
        'png'    => 'image/png',
        'pdf'    => 'application/pdf',
        'php'    => 'application/x-httpd-php',
        'ppt'    => 'application/vnd.ms-powerpoint',
        'pptx'   => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'rar'    => 'application/vnd.rar',
        'rtf'    => 'application/rtf',
        'sh'     => 'application/x-sh',
        'svg'    => 'image/svg+xml',
        'swf'    => 'application/x-shockwave-flash',
        'tar'    => 'application/x-tar',
        'tif'    => 'image/tiff',
        'tiff'   => 'image/tiff',
        'ts'     => 'video/mp2t',
        'ttf'    => 'font/ttf',
        'txt'    => 'text/plain',
        'vsd'    => 'application/vnd.visio',
        'wav'    => 'audio/wav',
        'weba'   => 'audio/webm',
        'webm'   => 'video/webm',
        'webp'   => 'image/webp',
        'woff'   => 'font/woff',
        'woff2'  => 'font/woff2',
        'xhtml'  => 'application/xhtml+xml',
        'xls'    => 'application/vnd.ms-excel',
        'xlsx'   => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'xml'    => 'text/xml',
        'xul'    => 'application/vnd.mozilla.xul+xml',
        'zip'    => 'application/zip',
        '3gp'    => 'video/3gpp',
        '3g2'    => 'video/3gpp2',
        '7z'     => 'application/x-7z-compressed',

    ];

    private $contentType, $charset;

    /**
     * @param $contentType
     */
    public function __construct($contentType)
    {
        [$contentType, $charset] = explode(';', $contentType);

        Assert::inArray($contentType, self::MIME_TYPES);

        $this->contentType = $contentType;
        $this->charset     = $charset;
    }

    public function isJson(): bool
    {
        return $this->contentType === self::MIME_TYPES['json'];
    }

    public function isText(): bool
    {
        return $this->contentType === self::MIME_TYPES['txt'];
    }

    public function __toString()
    {
        return $this->getCharSet() ?
            $this->getType() . ';' . $this->getCharSet() :
            $this->getType();
    }

    public function getType():string
    {
        return (string)$this->contentType;
    }

    public function getCharSet():string
    {
        return (string)$this->charset;
    }



}