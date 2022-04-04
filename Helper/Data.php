<?php

namespace Trellis\AdvancedEmailSettings\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Config paths
     */
    const CONFIG_ENABLED = 'trans_email/ident_replyto/enabled';
    const CONFIG_EMAIL_ADDRESS = 'trans_email/ident_replyto/email';
    const CONFIG_EMAIL_NAME = 'trans_email/ident_replyto/name';

    /**
     * Wrapper for get config values
     *
     * @param $path
     * @param null $store
     * @return mixed
     */
    protected function _getConfig($path, $store = null)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * Get reply to enabled
     *
     * @param null $store
     * @return bool
     */
    public function getReplyToEnabled($store = null)
    {
        return $this->_getConfig(self::CONFIG_ENABLED, $store);
    }

    /**
     * Get reply to address
     *
     * @param null $store
     * @return mixed
     */
    public function getReplyToEmailAddress($store = null)
    {
        return $this->_getConfig(self::CONFIG_EMAIL_ADDRESS, $store);
    }

    /**
     * Get reply to name
     *
     * @param null $store
     * @return mixed
     */
    public function getReplyToName($store = null)
    {
        return $this->_getConfig(self::CONFIG_EMAIL_NAME, $store);
    }
}