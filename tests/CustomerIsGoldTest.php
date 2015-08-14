<?php

class CustomerIsGoldTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    function a_customer_is_gold_if_they_have_the_respective_type()
    {
        $specification = new CustomerIsGold;

        $goldCustomer = new Customer(['type' => 'gold']);
        $silverCustomer = new Customer(['type' => 'silver']);

        $this->assertTrue($specification->isSatisfiedBy($goldCustomer));
        $this->assertFalse($specification->isSatisfiedBy($silverCustomer));
    }

}