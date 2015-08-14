<?php

class CustomerIsGold
{
    public function isSatisfiedBy(Customer $customer)
    {
        return $customer->type() == 'gold';
    }
}
