<?php

namespace Fastbill\Test;

use Mockery as m;
use Fastbill\FastBill;

class Base extends \Webforge\Code\Test\Base {

  protected $fastbill;
  protected $client;

  public  function setUp() {
    parent::setUp();
    $this->client = m::mock('Fastbill\HTTPClient');
    $this->client->shouldReceive('setUrl')->byDefault();

    $this->fastbill = new FastBill($this->client);
  }
}
