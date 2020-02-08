<?php

namespace NotificationChannels\Vfirst;

use GuzzleHttp\Client as Guzzle;

class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var ChannelConfig
     */
    protected $config;

    /**
     * Mobtexting constructor.
     *
     * @param \GuzzleHttp\Client $client
     * @param ChannelConfig     $config
     */
    public function __construct(ChannelConfig $config, $client = null)
    {
        $this->client = $client ?: new Guzzle();
        $this->config = $config;
    }

    /**
     * Send a MessageAbstract to the a phone number.
     *
     * @param MessageAbstract $message
     * @param string          $to
     * @param bool            $useAlphanumericSender
     *
     * @throws CouldNotSendNotification
     *
     * @return mixed
     */
    public function send(MessageAbstract $message, $to)
    {
        if ($message instanceof MessageAbstract) {
            return $this->sendSmsMessage($message, $to);
        }

        throw CouldNotSendNotification::invalidMessageObject($message);
    }

    /**
     * Send an sms message using the Mobtexting Service.
     *
     * @param Message $message
     * @param string  $to
     *
     * @throws CouldNotSendNotification
     *
     * @return \GuzzleHttp\Client
     */
    protected function sendSmsMessage(MessageAbstract $message, $to)
    {
        $params = [
            'from'     => $this->getFrom($message),
            'text'     => $message->getText(),
            'to'       => $message->getTo() ?: $to,
            'username' => $this->config->getUsername(),
            'password' => $this->config->getPassword(),
        ];

        $params = \array_merge($message->getParams(), $params);

        $url = 'http://global.myvaluefirst.com/smpp/vfmesms.jsp';

        return $this->client->request('GET', $url, [
            'query' => $params,
        ]);
    }

    /**
     * Get the from address from message, or config.
     *
     * @param MessageAbstract $message
     *
     * @throws CouldNotSendNotification
     *
     * @return string
     */
    protected function getFrom(MessageAbstract $message)
    {
        if (!$from = $message->getFrom() ?: $this->config->getFrom()) {
            throw Exceptions\CouldNotSendNotification::missingFrom();
        }

        return $from;
    }
}
