# Ezzar Countdown Timer

`Ezzar_CountdownTimer` adds a configurable countdown notification banner to Magento 2 Hyva storefronts using Alpine.js and Hyva Heroicons.

## Requirements

- Magento Open Source or Adobe Commerce 2.4.x
- PHP 8.1–8.4
- Hyva theme

## Installation

```bash
composer config repositories.ezzaro14-magento2-countdown-timer vcs https://github.com/Ezzaro14/magento2-countdown-timer.git
composer require ezzaro14/magento2-countdown-timer:dev-main
bin/magento module:enable Ezzar_CountdownTimer
bin/magento setup:upgrade
bin/magento cache:clean
```

Configure the banner under **Stores > Configuration > Ezzar > Countdown Timer**. The banner is inserted at `after.body.start`; a theme may reposition the `ezzar.header.countdown` block through layout XML.
