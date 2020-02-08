<?php

namespace NotificationChannels\Vfirst;

abstract class MessageAbstract
{
    /**
     * The message content.
     *
     * @var string
     */
    public $text;

    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from;

    /**
     * The service the message should be sent from.
     *
     * @var string
     */
    public $service;

    /**
     * The phone number the message should be sent to.
     *
     * @var string
     */
    public $to;

    /**
     * @var array
     */
    public $params = [];

    /**
     * Create a new message instance.
     *
     * @param string $text
     */
    public function __construct($text = '')
    {
        $this->text = $text;
    }

    /**
     * Create a message object.
     *
     * @param string $text
     *
     * @return static
     */
    public static function create($text = '')
    {
        return new static($text);
    }

    /**
     * Set the message content.
     *
     * @param string $text
     *
     * @return $this
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set the phone number the message should be sent from.
     *
     * @param string $from
     *
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set the phone number the message should be sent to.
     *
     * @param string $from
     * @param mixed  $to
     *
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get the from address.
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Get the phone number the message should be sent to.
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Get the message content.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get the service.
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Get the value of params.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set Param.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return self
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * Set Param.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return self
     */
    public function getParam($key, $default = null)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        };

        return $default;
    }

    /**
     * Set the value of params.
     *
     * @param array $params
     *
     * @return self
     */
    public function setParams(array $params)
    {
        $this->params = \array_merge($this->params, $params);

        return $this;
    }
}
