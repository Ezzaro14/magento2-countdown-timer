<?php
declare(strict_types=1);

namespace Ezzar\CountdownTimer\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class CountdownTimer implements ArgumentInterface
{
    public const XML_PATH_ENABLED = 'ezzar_countdown/general/enabled';
    public const XML_PATH_LABEL   = 'ezzar_countdown/general/label';
    public const XML_PATH_END_AT  = 'ezzar_countdown/general/end_at';
    public const XML_PATH_LINK    = 'ezzar_countdown/general/link_url';

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
        private readonly TimezoneInterface $timezone
    ) {
    }

    public function isEnabled(?int $storeId = null): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getLabel(?int $storeId = null): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_LABEL, ScopeInterface::SCOPE_STORE, $storeId);
    }

    public function getLinkUrl(?int $storeId = null): string
    {
        return trim((string) $this->scopeConfig->getValue(self::XML_PATH_LINK, ScopeInterface::SCOPE_STORE, $storeId));
    }

    /**
     * Returns end time as JS-friendly epoch milliseconds.
     * Interprets configured datetime in the store timezone.
     */
    public function getEndAtMs(?int $storeId = null): int
    {
        $value = trim((string) $this->scopeConfig->getValue(self::XML_PATH_END_AT, ScopeInterface::SCOPE_STORE, $storeId));
        if ($value === '') {
            return 0;
        }

        try {
            $utc = new \DateTime($value, new \DateTimeZone('UTC'));
            return (int) $utc->format('U') * 1000;
        } catch (\Throwable) {
            return 0;
        }
    }
}
