<?php

namespace Trellis\AdvancedEmailSettings\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class AddGlobalBcc
{
    /**
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;

    /**
     * AddGlobalBcc constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @param \Magento\Framework\Mail\Message $subject
     * @param mixed $result
     * @return mixed
     */
    public function afterAddTo(\Magento\Framework\Mail\Message $subject, $result)
    {
        if ($this->_scopeConfig->getValue('trellis_advancedemailsettings/general/active', ScopeInterface::SCOPE_STORE) == '1') {
            $bcc = explode(',',
                $this->_scopeConfig->getValue('trellis_advancedemailsettings/general/bcc', ScopeInterface::SCOPE_STORE)
            );

            if (!empty($bcc)) {
                foreach ($bcc as $email) {
                    $subject->addBcc($email);
                }
            }
        }

        return $subject;
    }
}