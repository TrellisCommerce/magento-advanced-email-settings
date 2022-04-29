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
Configure under Stores > Configuration > Trellis > Advanced Email Settings
Summary: sets a global BCC email address(es) to capture all of the emails triggered by Magento.

#### Reply-To
Configure under Stores > Configuration > General > Store Email Addresses > Reply To
Summary: sets the reply to name and email address for all emails sent by Magento.