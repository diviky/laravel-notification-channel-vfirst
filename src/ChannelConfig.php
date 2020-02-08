<?php

namespace NotificationChannels\Vfirst;

class ChannelConfig
{
    /**
     * @var array
     */
    protected $config;

    /**
     * MobtextingConfig constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get the auth token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->config['token'];
    }

    /**
     * Get the username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->config['username'];
    }

    /**
     * Get the password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->config['password'];
    }

    /**
     * Get the default from address.
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->config['from'];
    }
}
