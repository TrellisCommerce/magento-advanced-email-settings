<?php

declare(strict_types=1);

namespace Trellis\AdvancedEmailSettings\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * Config paths
     */
    const CONFIG_REPLY_TO_ENABLED = 'trans_email/ident_replyto/enabled';
    const CONFIG_REPLY_TO_EMAIL_ADDRESS = 'trans_email/ident_replyto/email';
    const CONFIG_REPLY_TO_EMAIL_NAME = 'trans_email/ident_replyto/name';

    const CONFIG_BCC_ACTIVE = 'trellis_advancedemailsettings/general/active';
    const CONFIG_BCC_EMAILS = 'trellis_advancedemailsettings/general/bcc';

    /**
     * Wrapper for get config values
     *
     * @param      $path
     * @param null $store
     *
     * @return mixed
     */
    protected function getConfig($path, $store = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * Get reply to enabled
     *
     * @param null $store
     *
     * @return bool
     */
    public function getReplyToEnabled($store = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::CONFIG_REPLY_TO_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Get reply to address
     *
     * @param null $store
     *
     * @return string
     */
    public function getReplyToEmailAddress($store = null): string
    {
        return $this->getConfig(self::CONFIG_REPLY_TO_EMAIL_ADDRESS, $store);
    }

    /**
     * Get reply to name
     *
     * @param null $store
     *
     * @return string
     */
    public function getReplyToName($store = null): string
    {
        return $this->getConfig(self::CONFIG_REPLY_TO_EMAIL_NAME, $store);
    }

    /**
     * Check if BCC emails are enabled.
     *
     * @param null $store
     *
     * @return bool
     */
    public function isBccEnabled($store = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::CONFIG_BCC_ACTIVE,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * Fetch BCC email addresses
     *
     * @param null $store
     *
     * @return array
     */
    public function getBccEmailAddresses($store = null): array
    {
        $bccEmails = $this->getConfig(self::CONFIG_BCC_EMAILS, $store);

        if (empty($bccEmails)) {
            return [];
        }

        return explode(',', $bccEmails);
    }
}