<?php

namespace NotificationChannels\Vfirst;

class Message extends MessageAbstract
{
    /**
     * @var null|string
     */
    public $alphaNumSender;

    /**
     * Get the from address of this message.
     *
     * @return null|string
     */
    public function getFrom()
    {
        if ($this->from) {
            return $this->from;
        }

        if ($this->alphaNumSender && \strlen($this->alphaNumSender) > 0) {
            return $this->alphaNumSender;
        }
    }

    /**
     * Set the alphanumeric sender.
     *
     * @param string $sender
     *
     * @return $this
     */
    public function sender($sender)
    {
        $this->alphaNumSender = $sender;

        return $this;
    }
}
