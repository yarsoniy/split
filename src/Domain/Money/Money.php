<?php

namespace Company\Split\Domain\Money;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Money
 * @package Company\Split\Domain\Money
 * @ORM\Embeddable()
 */
class Money
{
    /**
     * @var float
     * @ORM\Column(type="decimal")
     */
    private $value = 0;

    public function __construct(float $value = 0)
    {
        $this->value = $value;
    }

    public function add(Money $money): Money
    {
    }

    public function sub(Money $money): Money
    {
    }

    public function split(Money $money, int $parts): array
    {
    }

    public function merge(array $moneyParts): Money
    {
    }
}
