<?php

class CustomerIsGold {
    public function isSatisfiedBy(Customer $customer)
    {
        return $customer->type() == 'gold';
    }

    public function asScope($query)
    {
        return $query->where('type', 'gold');
    }
}