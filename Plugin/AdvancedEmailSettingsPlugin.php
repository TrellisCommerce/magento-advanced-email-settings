<?php

declare(strict_types=1);

namespace Trellis\AdvancedEmailSettings\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Psr\Log\LoggerInterface;
use Trellis\AdvancedEmailSettings\Helper\Data;

/**
 * Class AddReplyTo.
 */
class AdvancedEmailSettingsPlugin
{
    protected Data $helper;

    protected LoggerInterface $logger;

    protected ScopeConfigInterface $scopeConfig;

    protected string $templateIdentifier;

    /**
     * AddReplyTo constructor.
     *
     * @param LoggerInterface      $logger
     * @param Data                 $helper
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        LoggerInterface $logger,
        Data $helper,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->logger = $logger;
        $this->helper = $helper;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param TransportBuilder $subject
     * @param                  $templateIdentifier
     */
    public function beforeSetTemplateIdentifier(TransportBuilder $subject, $templateIdentifier)
    {
        $this->templateIdentifier = $templateIdentifier;
    }

    /**
     * Set replyTo for transactional emails, if enabled & configured via admin.
     *
     * @param TransportBuilder $subject
     */
    public function beforeGetTransport(TransportBuilder $subject)
    {
        if ($this->helper->getReplyToEnabled() && $replyToAddress = $this->helper->getReplyToEmailAddress()) {
            try {
                $subject->setReplyTo($replyToAddress, $this->helper->getReplyToName());
            } catch (\Exception $e) {
                $this->logger->debug($e->getMessage());
            }
        }

        if ($this->helper->isBccEnabled()) {
            $bcc = $this->helper->getBccEmailAddresses();
            $blacklist = $this->helper->getBccEmailTemplateBlacklist();

            if(in_array($this->templateIdentifier, $blacklist)) {
                return;
            }

            if (!empty($bcc)) {
                foreach ($bcc as $email) {
                    $subject->addBcc($email);
                }
            }
        }
    }
}
