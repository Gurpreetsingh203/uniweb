<?php

/**
 * A minimal Zendesk API PHP implementation
 *
 * @category   Helper
 * @author     Original Author <adrian.villamayor@gmail.com>
 * @link       https://github.com/AdrianVillamayor/ZendeskAPI
 *
 */

namespace Adrii;

class ZendeskAPI
{
    /**
     * @var string
     */
    protected $subdomain;

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var null|array
     */
    protected $uploads;

    /**
     * @var string
     */
    protected $base;

    /**
     * API Constructor.
     * @param string $subdomain
     * @param string $user
     * @param string $token
     */

    public function __construct($subdomain, $user, $token)
    {
        $this->subdomain  = $subdomain;
        $this->user       = $user;
        $this->token      = $token;
        $this->uploads    = array();

        $this->base       = 'https://' . $this->subdomain . '.zendesk.com/api/v2/';
    }

    private function _basicAuth()
    {
        $auth = $this->user . "/token:" . $this->token;

        return base64_encode($auth);
    }

    private function _buildUrl($endpoint)
    {
        return $this->base . $endpoint;
    }

    public function setUpload($token)
    {
        $this->upload[] = $token;
    }
   
    public function getUpload()
    {
        return $this->upload;
    }

    /**
     * Perform an API call.
     *
     * @param string $url='/tickets' Endpoint URL. Will automatically add the suffix you set if necessary (both '/tickets.json' and '/tickets' are valid)
     * @param array $json=array() An associative array of parameters
     * @param string $action Action to perform POST/GET/PUT
     *
     * @return mixed Automatically decodes JSON responses. If the response is not JSON, the response is returned as is
     */
    public function create($comments)
    {
        $endpoint = (count($comments) > 1) ? 'tickets/create_many.json' : 'tickets.json';

        $url = $this->_buildUrl($endpoint);

        $json = $this->_prepareTicket($comments);

        $curl = new CurlHelper();

        $curl->setUrl($url);
        $curl->setPostRaw($json);

        $curl->setHeaders([
            "Authorization" => "Basic {$this->_basicAuth()}"
        ]);

        $curl->setMime("json");

        $curl->execute();

        $response   = $curl->response();

        list($error, $msg) = $curl->parseCode();

        if (!$error) {
            return $response;
        } else {
            return FALSE;
        }
    }

    public function upload($filename, $tmp = "")
    {
        $endpoint = "uploads.json?filename={$filename}";

        $url = $this->_buildUrl($endpoint);

        $path = ($tmp == "") ? realpath($filename) : $tmp ;

        $curl = new CurlHelper();

        $curl->setUrl($url);

        $curl->setPostRaw(
            file_get_contents($path)
        );

        $curl->setMime("binary");

        $curl->setHeaders([
            "Authorization" => "Basic {$this->_basicAuth()}"
        ]);

        $curl->execute();

        $response   = $curl->response();

        list($error, $msg) = $curl->parseCode();

        $this->setUpload($response['upload']['token']);

        if (!$error) {
            return $response;
        } else {
            return FALSE;
        }
    }

    private function _prepareTicket($comments)
    {
        $ticket = array();

        $parent_node = (count($comments) > 1) ? "tickets" : "ticket";

        $ticket[$parent_node]  = (count($comments) > 1) ? $comments : $comments[0];

        return json_encode($ticket);
    }
}
