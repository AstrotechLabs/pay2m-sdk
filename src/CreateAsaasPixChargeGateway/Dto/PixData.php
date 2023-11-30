<?php

namespace Astrotech\AsaasGateway\CreateAsaasPixChargeGateway\Dto;

use Astrotech\AsaasGateway\Enum\BillingTypes;

final class PixData
{
    public function __construct(
        public readonly string $customer,
        public readonly BillingTypes $billingType,
        public readonly float $value,
        public readonly string $dueDate
    ) {
    }

    public function values(): array
    {
        $values = get_object_vars($this);
        array_walk($values, fn (&$value, $property) => $value = $this->get($property));
        return $values;
    }

    public function get(string $property): mixed
    {
        $getter = "get" . ucfirst($property);

        if (method_exists($this, $getter)) {
            return $this->{$getter}();
        }

        return $this->{$property};
    }

    public function getBillingType(): string
    {
        return $this->billingType->value;
    }
}