Brought to you and maintained by [Trellis Commerce](https://trellis.co/) - A full-service eCommerce agency based in Boston, MA.

## Trellis Advanced Email Settings

Magento 2 extension that includes extra email settings that are helpful to the client.


## Installation

Follow the instructions below to install this extension using Composer.

```
composer config repositories.trellis/module-advanced-email-settings git git@github.com:TrellisCommerce/magento-advanced-email-settings
composer require trellis/module-advanced-email-settings
bin/magento module:enable --clear-static-content Trellis_AdvancedEmailSettings
bin/magento setup:upgrade
bin/magento cache:flush
```

## Configuration

#### Global BCC
Configure under Stores > Configuration > Trellis > Advanced Email Settings > Global BCC
* "Enabled?" - enabling this setting will add any specified BCC email address(es) on all emails sent by Magento.
* "BCC Email Address(es)" - a comma separated list of email addresses.
* "BCC Email Template Blacklist" - allows control of which email templates do NOT trigger a BCC email. This is useful 
  for more confidential emails like password reset. This is a comma separated list of the email template identifiers 
  that should NOT receive the BCC emails. 

#### Reply-To
Configure under Stores > Configuration > General > Store Email Addresses > Reply To.
* "Enabled" - enabling this setting will add a "reply-to" header on all emails sent by Magento.
* "Reply To Email" - any responses on emails that Magento sends will be sent to this email address.
* "Reply To Name" - the display name for the Reply To email address.