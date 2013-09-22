<?php

namespace Fastbill;

use Mockery as m;

class FastbillTest extends Test\Base {
  
  public function setUp() {
    $this->chainClass = 'Fastbill\\Fastbill';
    parent::setUp();
  }

  public function testGetServiceForCustomers() {
    $customers = $this->fastbill->getCustomerService();

    $this->assertInstanceOf('Fastbill\Service\CustomerService', $customers);
  }
}
