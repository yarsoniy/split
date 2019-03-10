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

    /**
     * Money constructor.
     * @param float $value
     */
    public function __construct(float $value = 0)
    {
        $this->value = $value;
    }

    /**
     * @param Money $money
     * @return Money
     */
    public function add(Money $money): Money
    {

    }

    /**
     * @param Money $money
     * @return Money
     *
     */
    public function sub(Money $money): Money
    {

    }

    /**
     * @param Money $money
     * @param int $parts
     * @return array
     */
    public function split(Money $money, int $parts): array
    {

    }

    /**
     * @param array $moneyParts
     * @return Money
     */
    public function merge(array $moneyParts): Money
    {

    }
}
