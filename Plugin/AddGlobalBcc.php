<?php

declare(strict_types=1);

namespace Trellis\AdvancedEmailSettings\Plugin;

use Magento\Framework\Mail\Message;
use Trellis\AdvancedEmailSettings\Helper\Data;

class AddGlobalBcc
{
    protected Data $configData;

    /**
     * AddGlobalBcc constructor
     *
     * @param Data $configData
     */
    public function __construct(
        Data $configData
    ) {
        $this->configData = $configData;
    }

    /**
     * @param Message $subject
     * @param mixed   $result
     *
     * @return mixed
     */
    public function afterAddTo(Message $subject, $result)
    {
        if (!$this->configData->isBccEnabled()) {
            return $result;
        }

        $bcc = $this->configData->getBccEmailAddresses();

        if (!empty($bcc)) {
            foreach ($bcc as $email) {
                $subject->addBcc($email);
            }
        }

        return $subject;
    }
}