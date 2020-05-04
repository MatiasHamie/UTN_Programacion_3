<?php
class Response
{
    protected $status;
    protected $data;

    public function __construct($data)
    {
        $this->status = $this->Contains_Data($data);
        $this->data = ($this->status == '200: Success') ? $data : null;
    }

    public function Contains_Data($data)
    {
        return isset($data) ? '200: Success' : '404: Data Not Found';
    }
}