<?php
/**
 * Created by PhpStorm.
 * User: AmorPro
 * Date: 12.08.2021
 * Time: 23:24
 */

namespace SmokeTests\Http;

use Webmozart\Assert\Assert;

class Header
{
    // Permanent Message Headers

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const A_IM = 'A-IM';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.2
     */
    public const ACCEPT = 'Accept';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const ACCEPT_ADDITIONS = 'Accept-Additions';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.3
     */
    public const ACCEPT_CHARSET = 'Accept-Charset';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7089
     */
    public const ACCEPT_DATETIME = 'Accept-Datetime';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.4
     * @see https://tools.ietf.org/html/rfc7694#section-3
     */
    public const ACCEPT_ENCODING = 'Accept-Encoding';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const ACCEPT_FEATURES = 'Accept-Features';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.5
     */
    public const ACCEPT_LANGUAGE = 'Accept-Language';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc5789
     */
    public const ACCEPT_PATCH = 'Accept-Patch';

    /**
     * @var string
     * @see https://www.w3.org/TR/ldp/
     */
    public const ACCEPT_POST = 'Accept-Post';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7233#section-2.3
     */
    public const ACCEPT_RANGES = 'Accept-Ranges';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7234#section-5.1
     */
    public const AGE = 'Age';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-7.4.1
     */
    public const ALLOW = 'Allow';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7639#section-2
     */
    public const ALPN = 'ALPN';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7838
     */
    public const ALT_SVC = 'Alt-Svc';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7838
     */
    public const ALT_USED = 'Alt-Used';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const ALTERNATES = 'Alternates';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4437
     */
    public const APPLY_TO_REDIRECT_REF = 'Apply-To-Redirect-Ref';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc8053#section-4
     */
    public const AUTHENTICATION_CONTROL = 'Authentication-Control';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7615#section-3
     */
    public const AUTHENTICATION_INFO = 'Authentication-Info';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7235#section-4.2
     */
    public const AUTHORIZATION = 'Authorization';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const C_EXT = 'C-Ext';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const C_MAN = 'C-Man';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const C_OPT = 'C-Opt';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const C_PEP = 'C-PEP';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const C_PEP_INFO = 'C-PEP-Info';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7234#section-5.2
     */
    public const CACHE_CONTROL = 'Cache-Control';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7809#section-7.1
     */
    public const CALDAV_TIMEZONES = 'CalDAV-Timezones';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-8.1
     */
    public const CLOSE = 'Close';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-6.1
     */
    public const CONNECTION = 'Connection';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc2068
     * @deprecated
     */
    public const CONTENT_BASE = 'Content-Base';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6266
     */
    public const CONTENT_DISPOSITION = 'Content-Disposition';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.2.2
     */
    public const CONTENT_ENCODING = 'Content-Encoding';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const CONTENT_ID = 'Content-ID';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.3.2
     */
    public const CONTENT_LANGUAGE = 'Content-Language';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-3.3.2
     */
    public const CONTENT_LENGTH = 'Content-Length';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.4.2
     */
    public const CONTENT_LOCATION = 'Content-Location';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const CONTENT_MD5 = 'Content-MD5';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7233#section-4.2
     */
    public const CONTENT_RANGE = 'Content-Range';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const CONTENT_SCRIPT_TYPE = 'Content-Script-Type';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const CONTENT_STYLE_TYPE = 'Content-Style-Type';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.1.5
     */
    public const CONTENT_TYPE = 'Content-Type';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const CONTENT_VERSION = 'Content-Version';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6265
     */
    public const COOKIE = 'Cookie';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc2965
     * @deprecated
     */
    public const COOKIE2 = 'Cookie2';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc5323
     */
    public const DASL = 'DASL';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4918
     */
    public const DAV = 'DAV';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.1.2
     */
    public const DATE = 'Date';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const DEFAULT_STYLE = 'Default-Style';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const DELTA_BASE = 'Delta-Base';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4918
     */
    public const DEPTH = 'Depth';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const DERIVED_FROM = 'Derived-From';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4918
     */
    public const DESTINATION = 'Destination';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const DIFFERENTIAL_ID = 'Differential-ID';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const DIGEST = 'Digest';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7232#section-2.3
     */
    public const ETAG = 'ETag';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.1.1
     */
    public const EXPECT = 'Expect';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7234#section-5.3
     */
    public const EXPIRES = 'Expires';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const EXT = 'Ext';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7239
     */
    public const FORWARDED = 'Forwarded';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.1
     */
    public const FROM = 'From';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const GETPROFILE = 'GetProfile';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7486#section-6.1.1
     */
    public const HOBAREG = 'Hobareg';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-5.4
     */
    public const HOST = 'Host';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7540#section-3.2.1
     */
    public const HTTP2_SETTINGS = 'HTTP2-Settings';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const IM = 'IM';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4918
     */
    public const IF = 'If';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7232#section-3.1
     */
    public const IF_MATCH = 'If-Match';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7232#section-3.3
     */
    public const IF_MODIFIED_SINCE = 'If-Modified-Since';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7232#section-3.2
     */
    public const IF_NONE_MATCH = 'If-None-Match';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7233#section-3.2
     */
    public const IF_RANGE = 'If-Range';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6638
     */
    public const IF_SCHEDULE_TAG_MATCH = 'If-Schedule-Tag-Match';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7232#section-3.4
     */
    public const IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const KEEP_ALIVE = 'Keep-Alive';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const LABEL = 'Label';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7232#section-2.2
     */
    public const LAST_MODIFIED = 'Last-Modified';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc5988
     */
    public const LINK = 'Link';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.2
     */
    public const LOCATION = 'Location';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4918
     */
    public const LOCK_TOKEN = 'Lock-Token';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const MAN = 'Man';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.1.2
     */
    public const MAX_FORWARDS = 'Max-Forwards';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7089
     */
    public const MEMENTO_DATETIME = 'Memento-Datetime';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const METER = 'Meter';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231
     */
    public const MIME_VERSION = 'MIME-Version';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const NEGOTIATE = 'Negotiate';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const OPT = 'Opt';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc8053#section-3
     */
    public const OPTIONAL_WWW_AUTHENTICATE = 'Optional-WWW-Authenticate';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const ORDERING_TYPE = 'Ordering-Type';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6454
     */
    public const ORIGIN = 'Origin';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4918
     */
    public const OVERWRITE = 'Overwrite';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const P3P = 'P3P';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PEP = 'PEP';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PICS_LABEL = 'PICS-Label';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PEP_INFO = 'Pep-Info';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const POSITION = 'Position';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7234#section-5.4
     */
    public const PRAGMA = 'Pragma';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7240
     */
    public const PREFER = 'Prefer';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7240
     */
    public const PREFERENCE_APPLIED = 'Preference-Applied';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PROFILEOBJECT = 'ProfileObject';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PROTOCOL = 'Protocol';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PROTOCOL_INFO = 'Protocol-Info';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PROTOCOL_QUERY = 'Protocol-Query';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PROTOCOL_REQUEST = 'Protocol-Request';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7235#section-4.3
     */
    public const PROXY_AUTHENTICATE = 'Proxy-Authenticate';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7615#section-4
     */
    public const PROXY_AUTHENTICATION_INFO = 'Proxy-Authentication-Info';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7235#section-4.4
     */
    public const PROXY_AUTHORIZATION = 'Proxy-Authorization';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PROXY_FEATURES = 'Proxy-Features';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PROXY_INSTRUCTION = 'Proxy-Instruction';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const PUBLIC = 'Public';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7469
     */
    public const PUBLIC_KEY_PINS = 'Public-Key-Pins';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7469
     */
    public const PUBLIC_KEY_PINS_REPORT_ONLY = 'Public-Key-Pins-Report-Only';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7233#section-3.1
     */
    public const RANGE = 'Range';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4437
     */
    public const REDIRECT_REF = 'Redirect-Ref';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.2
     */
    public const REFERER = 'Referer';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.3
     */
    public const RETRY_AFTER = 'Retry-After';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SAFE = 'Safe';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6638
     */
    public const SCHEDULE_REPLY = 'Schedule-Reply';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6638
     */
    public const SCHEDULE_TAG = 'Schedule-Tag';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6455
     */
    public const SEC_WEBSOCKET_ACCEPT = 'Sec-WebSocket-Accept';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6455
     */
    public const SEC_WEBSOCKET_EXTENSIONS = 'Sec-WebSocket-Extensions';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6455
     */
    public const SEC_WEBSOCKET_KEY = 'Sec-WebSocket-Key';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6455
     */
    public const SEC_WEBSOCKET_PROTOCOL = 'Sec-WebSocket-Protocol';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6455
     */
    public const SEC_WEBSOCKET_VERSION = 'Sec-WebSocket-Version';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SECURITY_SCHEME = 'Security-Scheme';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-7.4.2
     */
    public const SERVER = 'Server';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6265
     */
    public const SET_COOKIE = 'Set-Cookie';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc2965
     * @deprecated
     */
    public const SET_COOKIE2 = 'Set-Cookie2';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SETPROFILE = 'SetProfile';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc5023
     */
    public const SLUG = 'SLUG';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SOAPACTION = 'SoapAction';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const STATUS_URI = 'Status-URI';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6797
     */
    public const STRICT_TRANSPORT_SECURITY = 'Strict-Transport-Security';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SURROGATE_CAPABILITY = 'Surrogate-Capability';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SURROGATE_CONTROL = 'Surrogate-Control';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const TCN = 'TCN';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-4.3
     */
    public const TE = 'TE';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4918
     */
    public const TIMEOUT = 'Timeout';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc8030#section-5.4
     */
    public const TOPIC = 'Topic';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-4.4
     */
    public const TRAILER = 'Trailer';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-3.3.1
     */
    public const TRANSFER_ENCODING = 'Transfer-Encoding';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc8030#section-5.2
     */
    public const TTL = 'TTL';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc8030#section-5.3
     */
    public const URGENCY = 'Urgency';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const URI = 'URI';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-6.7
     */
    public const UPGRADE = 'Upgrade';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.3
     */
    public const USER_AGENT = 'User-Agent';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const VARIANT_VARY = 'Variant-Vary';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.4
     */
    public const VARY = 'Vary';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7230#section-5.7.1
     */
    public const VIA = 'Via';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7235#section-4.1
     */
    public const WWW_AUTHENTICATE = 'WWW-Authenticate';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const WANT_DIGEST = 'Want-Digest';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7234#section-5.5
     */
    public const WARNING = 'Warning';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc7034
     */
    public const X_FRAME_OPTIONS = 'X-Frame-Options';

    // Provisional Message Headers

    /**
     * @var string
     * @deprecated
     */
    public const ACCESS_CONTROL = 'Access-Control';

    /**
     * @var string
     * @see https://fetch.spec.whatwg.org/#http-requests
     */
    public const ACCESS_CONTROL_ALLOW_CREDENTIALS = 'Access-Control-Allow-Credentials';

    /**
     * @var string
     */
    public const ACCESS_CONTROL_ALLOW_HEADERS = 'Access-Control-Allow-Headers';

    /**
     * @var string
     */
    public const ACCESS_CONTROL_ALLOW_METHODS = 'Access-Control-Allow-Methods';

    /**
     * @var string
     */
    public const ACCESS_CONTROL_ALLOW_ORIGIN = 'Access-Control-Allow-Origin';

    /**
     * @var string
     */
    public const ACCESS_CONTROL_MAX_AGE = 'Access-Control-Max-Age';

    /**
     * @var string
     */
    public const ACCESS_CONTROL_REQUEST_METHOD = 'Access-Control-Request-Method';

    /**
     * @var string
     */
    public const ACCESS_CONTROL_REQUEST_HEADERS = 'Access-Control-Request-Headers';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const COMPLIANCE = 'Compliance';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const CONTENT_TRANSFER_ENCODING = 'Content-Transfer-Encoding';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const COST = 'Cost';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc6017
     */
    public const EDIINT_FEATURES = 'EDIINT-Features';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const MESSAGE_ID = 'Message-ID';

    /**
     * @var string
     * @deprecated
     */
    public const METHOD_CHECK = 'Method-Check';

    /**
     * @var string
     * @deprecated
     */
    public const METHOD_CHECK_EXPIRES = 'Method-Check-Expires';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const NON_COMPLIANCE = 'Non-Compliance';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const OPTIONAL = 'Optional';

    /**
     * @var string
     * @deprecated
     */
    public const REFERER_ROOT = 'Referer-Root';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const RESOLUTION_HINT = 'Resolution-Hint';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const RESOLVER_LOCATION = 'Resolver-Location';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SUBOK = 'SubOK';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const SUBST = 'Subst';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const TITLE = 'Title';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const UA_COLOR = 'UA-Color';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const UA_MEDIA = 'UA-Media';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const UA_PIXELS = 'UA-Pixels';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const UA_RESOLUTION = 'UA-Resolution';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const UA_WINDOWPIXELS = 'UA-Windowpixels';

    /**
     * @var string
     * @see https://tools.ietf.org/html/rfc4229
     */
    public const VERSION = 'Version';

    /**
     * @var string
     */
    public const X_DEVICE_ACCEPT = 'X-Device-Accept';

    /**
     * @var string
     */
    public const X_DEVICE_ACCEPT_CHARSET = 'X-Device-Accept-Charset';

    /**
     * @var string
     */
    public const X_DEVICE_ACCEPT_ENCODING = 'X-Device-Accept-Encoding';

    /**
     * @var string
     */
    public const X_DEVICE_ACCEPT_LANGUAGE = 'X-Device-Accept-Language';

    /**
     * @var string
     */
    public const X_DEVICE_USER_AGENT = 'X-Device-User-Agent';

    // Non-standard Headers

    /**
     * @var string
     * @see https://www.w3.org/TR/CSP3/#csp-header
     */
    public const CONTENT_SECURITY_POLICY = 'Content-Security-Policy';

    /**
     * @var string
     */
    public const DNT = 'DNT';

    /**
     * @var string
     */
    public const PROXY_CONNECTION = 'Proxy-Connection';

    /**
     * @var string
     */
    public const STATUS = 'Status';

    /**
     * @var string
     */
    public const UPGRADE_INSECURE_REQUESTS = 'Upgrade-Insecure-Requests';

    /**
     * @var string
     */
    public const X_CONTENT_DURATION = 'X-Content-Duration';

    /**
     * @var string
     */
    public const X_CONTENT_SECURITY_POLICY = 'X-Content-Security-Policy';

    /**
     * @var string
     */
    public const X_CONTENT_TYPE_OPTIONS = 'X-Content-Type-Options';

    /**
     * @var string
     */
    public const X_CORRELATION_ID = 'X-Correlation-ID';

    /**
     * @var string
     */
    public const X_CSRF_TOKEN = 'X-Csrf-Token';

    /**
     * @var string
     */
    public const X_FORWARDED_FOR = 'X-Forwarded-For';

    /**
     * @var string
     */
    public const X_FORWARDED_HOST = 'X-Forwarded-Host';

    /**
     * @var string
     */
    public const X_FORWARDED_PROTO = 'X-Forwarded-Proto';

    /**
     * @var string
     */
    public const X_HTTP_METHOD_OVERRIDE = 'X-Http-Method-Override';

    /**
     * @var string
     */
    public const X_POWERED_BY = 'X-Powered-By';

    /**
     * @var string
     */
    public const X_REQUEST_ID = 'X-Request-ID';

    /**
     * @var string
     */
    public const X_REQUESTED_WITH = 'X-Requested-With';

    /**
     * @var string
     */
    public const X_UA_COMPATIBLE = 'X-UA-Compatible';

    /**
     * @var string
     */
    public const X_UIDH = 'X-UIDH';

    /**
     * @var string
     */
    public const X_WAP_PROFILE = 'X-Wap-Profile';

    /**
     * @var string
     */
    public const X_WEBKIT_CSP = 'X-WebKit-CSP';

    /**
     * @var string
     */
    public const X_XSS_PROTECTION = 'X-XSS-Protection';

    private const HEADERS = [
        self::A_IM,
        self::ACCEPT,
        self::ACCEPT_ADDITIONS,
        self::ACCEPT_CHARSET,
        self::ACCEPT_DATETIME,
        self::ACCEPT_ENCODING,
        self::ACCEPT_FEATURES,
        self::ACCEPT_LANGUAGE,
        self::ACCEPT_PATCH,
        self::ACCEPT_POST,
        self::ACCEPT_RANGES,
        self::AGE,
        self::ALLOW,
        self::ALPN,
        self::ALT_SVC,
        self::ALT_USED,
        self::ALTERNATES,
        self::APPLY_TO_REDIRECT_REF,
        self::AUTHENTICATION_CONTROL,
        self::AUTHENTICATION_INFO,
        self::AUTHORIZATION,
        self::C_EXT,
        self::C_MAN,
        self::C_OPT,
        self::C_PEP,
        self::C_PEP_INFO,
        self::CACHE_CONTROL,
        self::CALDAV_TIMEZONES,
        self::CLOSE,
        self::CONNECTION,
        self::CONTENT_DISPOSITION,
        self::CONTENT_ENCODING,
        self::CONTENT_ID,
        self::CONTENT_LANGUAGE,
        self::CONTENT_LENGTH,
        self::CONTENT_LOCATION,
        self::CONTENT_MD5,
        self::CONTENT_RANGE,
        self::CONTENT_SCRIPT_TYPE,
        self::CONTENT_STYLE_TYPE,
        self::CONTENT_TYPE,
        self::CONTENT_VERSION,
        self::COOKIE,
        self::DASL,
        self::DAV,
        self::DATE,
        self::DEFAULT_STYLE,
        self::DELTA_BASE,
        self::DEPTH,
        self::DERIVED_FROM,
        self::DESTINATION,
        self::DIFFERENTIAL_ID,
        self::DIGEST,
        self::ETAG,
        self::EXPECT,
        self::EXPIRES,
        self::EXT,
        self::FORWARDED,
        self::FROM,
        self::GETPROFILE,
        self::HOBAREG,
        self::HOST,
        self::HTTP2_SETTINGS,
        self::IM,
        self::IF,
        self::IF_MATCH,
        self::IF_MODIFIED_SINCE,
        self::IF_NONE_MATCH,
        self::IF_RANGE,
        self::IF_SCHEDULE_TAG_MATCH,
        self::IF_UNMODIFIED_SINCE,
        self::KEEP_ALIVE,
        self::LABEL,
        self::LAST_MODIFIED,
        self::LINK,
        self::LOCATION,
        self::LOCK_TOKEN,
        self::MAN,
        self::MAX_FORWARDS,
        self::MEMENTO_DATETIME,
        self::METER,
        self::MIME_VERSION,
        self::NEGOTIATE,
        self::OPT,
        self::OPTIONAL_WWW_AUTHENTICATE,
        self::ORDERING_TYPE,
        self::ORIGIN,
        self::OVERWRITE,
        self::P3P,
        self::PEP,
        self::PICS_LABEL,
        self::PEP_INFO,
        self::POSITION,
        self::PRAGMA,
        self::PREFER,
        self::PREFERENCE_APPLIED,
        self::PROFILEOBJECT,
        self::PROTOCOL,
        self::PROTOCOL_INFO,
        self::PROTOCOL_QUERY,
        self::PROTOCOL_REQUEST,
        self::PROXY_AUTHENTICATE,
        self::PROXY_AUTHENTICATION_INFO,
        self::PROXY_AUTHORIZATION,
        self::PROXY_FEATURES,
        self::PROXY_INSTRUCTION,
        self::PUBLIC,
        self::PUBLIC_KEY_PINS,
        self::PUBLIC_KEY_PINS_REPORT_ONLY,
        self::RANGE,
        self::REDIRECT_REF,
        self::REFERER,
        self::RETRY_AFTER,
        self::SAFE,
        self::SCHEDULE_REPLY,
        self::SCHEDULE_TAG,
        self::SEC_WEBSOCKET_ACCEPT,
        self::SEC_WEBSOCKET_EXTENSIONS,
        self::SEC_WEBSOCKET_KEY,
        self::SEC_WEBSOCKET_PROTOCOL,
        self::SEC_WEBSOCKET_VERSION,
        self::SECURITY_SCHEME,
        self::SERVER,
        self::SET_COOKIE,
        self::SETPROFILE,
        self::SLUG,
        self::SOAPACTION,
        self::STATUS_URI,
        self::STRICT_TRANSPORT_SECURITY,
        self::SURROGATE_CAPABILITY,
        self::SURROGATE_CONTROL,
        self::TCN,
        self::TE,
        self::TIMEOUT,
        self::TOPIC,
        self::TRAILER,
        self::TRANSFER_ENCODING,
        self::TTL,
        self::URGENCY,
        self::URI,
        self::UPGRADE,
        self::USER_AGENT,
        self::VARIANT_VARY,
        self::VARY,
        self::VIA,
        self::WWW_AUTHENTICATE,
        self::WANT_DIGEST,
        self::WARNING,
        self::X_FRAME_OPTIONS,
        self::ACCESS_CONTROL_ALLOW_CREDENTIALS,
        self::ACCESS_CONTROL_ALLOW_HEADERS,
        self::ACCESS_CONTROL_ALLOW_METHODS,
        self::ACCESS_CONTROL_ALLOW_ORIGIN,
        self::ACCESS_CONTROL_MAX_AGE,
        self::ACCESS_CONTROL_REQUEST_METHOD,
        self::ACCESS_CONTROL_REQUEST_HEADERS,
        self::COMPLIANCE,
        self::CONTENT_TRANSFER_ENCODING,
        self::COST,
        self::EDIINT_FEATURES,
        self::MESSAGE_ID,
        self::NON_COMPLIANCE,
        self::OPTIONAL,
        self::RESOLUTION_HINT,
        self::RESOLVER_LOCATION,
        self::SUBOK,
        self::SUBST,
        self::TITLE,
        self::UA_COLOR,
        self::UA_MEDIA,
        self::UA_PIXELS,
        self::UA_RESOLUTION,
        self::UA_WINDOWPIXELS,
        self::VERSION,
        self::X_DEVICE_ACCEPT,
        self::X_DEVICE_ACCEPT_CHARSET,
        self::X_DEVICE_ACCEPT_ENCODING,
        self::X_DEVICE_ACCEPT_LANGUAGE,
        self::X_DEVICE_USER_AGENT,
        self::CONTENT_SECURITY_POLICY,
        self::DNT,
        self::PROXY_CONNECTION,
        self::STATUS,
        self::UPGRADE_INSECURE_REQUESTS,
        self::X_CONTENT_DURATION,
        self::X_CONTENT_SECURITY_POLICY,
        self::X_CONTENT_TYPE_OPTIONS,
        self::X_CORRELATION_ID,
        self::X_CSRF_TOKEN,
        self::X_FORWARDED_FOR,
        self::X_FORWARDED_HOST,
        self::X_FORWARDED_PROTO,
        self::X_HTTP_METHOD_OVERRIDE,
        self::X_POWERED_BY,
        self::X_REQUEST_ID,
        self::X_REQUESTED_WITH,
        self::X_UA_COMPATIBLE,
        self::X_UIDH,
        self::X_WAP_PROFILE,
        self::X_WEBKIT_CSP,
        self::X_XSS_PROTECTION,
    ];

    private $name, $value;

    /**
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        Assert::inArray(strtolower(trim($name)), $this->getKnownHeadersForValidation(), 'Invalid header name ' . $name);
        Assert::notEmpty($value, 'Invalid value');

        $this->name  = $name;
        $this->value = trim($value);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s: %s', $this->name, $this->value);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return array
     */
    private function getKnownHeadersForValidation(): array
    {
        static $headersForValidation = null;

        if(!$headersForValidation) {
            $headersForValidation = array_map('strtolower', self::HEADERS);
        }

        return $headersForValidation;
    }

    /**
     * @param Header $header
     * @return bool
     */
    public function isEqualTo(Header $header): bool
    {
        return strtolower($this->getName()) === strtolower($header->getName())
            && strtolower($this->getValue())=== strtolower($header->getValue());
    }

}