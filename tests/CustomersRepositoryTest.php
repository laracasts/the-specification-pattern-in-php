<?php

use Illuminate\Database\Capsule\Manager as DB;

class CustomersRepositoryTest extends PHPUnit_Framework_TestCase
{
    protected $customers;

    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();

        $this->customers =  new CustomersRepository;
    }

    protected function setUpDatabase()
    {
        $database = new DB;

        $database->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);

        $database->bootEloquent();
        $database->setAsGlobal();
    }

    protected function migrateTables()
    {
        DB::schema()->create('customers', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        Customer::create(['name' => 'Joe', 'type' => 'gold']);
        Customer::create(['name' => 'Jane', 'type' => 'silver']);
    }

    /** @test */
    function it_fetches_all_customers()
    {
        $results = $this->customers->all();

        $this->assertCount(2, $results);
    }

    /** @test */
    function it_fetches_all_customers_who_match_a_given_specification()
    {
        $results = $this->customers->whoMatch(new CustomerIsGold);

        $this->assertCount(1, $results);
    }

}