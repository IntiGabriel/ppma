<?php


class Response extends CJSON
{

    protected $messages = [];

    protected $error = false;

    protected $data  = [];


    public function addMessage($msg)
    {
        $this->messages[] = $msg;
        return $this;
    }


    public function addMessages($messages = [])
    {
        $this->messages = array_merge($this->messages, $messages);
    }


    public function addData($value, $key = null)
    {
        if ($key === null)
        {
            $this->data[] = $value;
        }
        else
        {
            $this->data[$key] = $value;
        }

        return $this;
    }

    public function setError($value)
    {
        $this->error = $value;
        return $this;
    }


    public function send()
    {
        header('Content-type: application/json');
        echo CJSON::encode([
            'error'    => $this->error,
            'messages' => $this->messages,
            'data'     => $this->data
        ]);
    }

}