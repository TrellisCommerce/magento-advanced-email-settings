<?php

namespace Trellis\AdvancedEmailSettings\Plugin;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Psr\Log\LoggerInterface;
use Trellis\AdvancedEmailSettings\Helper\Data;

/**
 * Class AddReplyTo.
 */
class AddReplyToPlugin
{
    /**
     * @var |Trellis|AdvancedEmailSettings|Helper|Data
     */
    protected $_helper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;

    /**
     * AddReplyTo constructor.
     *
     * @param |Psr|Log|LogInterface $logger
     * @param |Trellis|AdvancedEmailSettings|Data $helper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        LoggerInterface $logger,
        Data $helper,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->_logger = $logger;
        $this->_helper = $helper;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Set replyTo for transactional emails, if enabled & configured via admin.
     *
     * @param TransportBuilder $subject
     */
    public function beforeGetTransport(\Magento\Framework\Mail\Template\TransportBuilder $subject)
    {
        if ($this->_helper->getReplyToEnabled() &&
            $replyToAddress = $this->_helper->getReplyToEmailAddress()
        ) {
            try {
                $subject->setReplyTo($replyToAddress, $this->_helper->getReplyToName());
            } catch (\Exception $e) {
                $this->_logger->debug($e->getMessage());
            }
       }

        if ($this->_scopeConfig->getValue('trellis_advancedemailsettings/general/status', ScopeInterface::SCOPE_STORE) == '1') {
            $bcc = explode(',',
                $this->_scopeConfig->getValue('trellis_advancedemailsettings/general/bcc', ScopeInterface::SCOPE_STORE)
            );

            if (!empty($bcc)) {
                foreach ($bcc as $email) {
                    $subject->addBcc($email);
                }
            }
        }
    }
}
