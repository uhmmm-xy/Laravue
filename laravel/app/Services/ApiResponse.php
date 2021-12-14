<?php
namespace Services;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return \Illuminate\Http\Response
     */
    public function respond($data, $header = [])
    {
        $content = preg_replace(
            [
                '/":null/',
                '/":true/',
                '/":false/',
            ],
            [
                '":""',
                '":1',
                '":0',
            ],
            json_encode($data, JSON_UNESCAPED_UNICODE)
        );
        return response($content, $this->getStatusCode(), $header);
    }

    /**
     * @param $status
     * @param array $data
     * @param null $code
     * @return \Illuminate\Http\Response
     */
    public function status($status, array $data, $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        $data = array_merge($status, $data);
        return $this->respond($data);
    }

    /**
     * @param $message
     * @param int $code
     * @param string $status
     * @return \Illuminate\Http\Response
     */
    public function failed($message, $code = FoundationResponse::HTTP_BAD_REQUEST, $status = 'error')
    {
        return $this->setStatusCode($code)->message($message, $status);
    }

    /**
     * @param $message
     * @param string $status
     * @return \Illuminate\Http\Response
     */
    public function message($message, $status = "success")
    {
        return $this->status($status, [
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public function internalError($message = "Internal Error!")
    {
        return $this->failed($message, FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public function created($message = "created")
    {
        return $this->setStatusCode(FoundationResponse::HTTP_CREATED)
            ->message($message);
    }

    /**
     * @param $data
     * @param string $status
     * @return \Illuminate\Http\Response
     */
    public function success($data = [], $status = "success")
    {
        return $this->status($status, compact('data'));
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public function notFound($message = 'Not Found!')
    {
        return $this->failed($message, FoundationResponse::HTTP_NOT_FOUND);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\Response
     */
    public function unauthorized($message = 'Unauthorized!')
    {
        return $this->failed($message, FoundationResponse::HTTP_UNAUTHORIZED);
    }
}
