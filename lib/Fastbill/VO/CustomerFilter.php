<?php
namespace Fastbill\VO;

require_once __DIR__ . '/AbstractFilter.php';

class CustomerFilter extends AbstractFilter
{
    /** @var int */
    private $id;

    /** @var int  */
    private $number;

    /** @var string  */
    private $countryCode;

    /** @var string */
    private $city;

    /** @var string */
    private $term;

    protected function getFilterArray()
    {
        $array = array();
        if ($this->id) {
            $array['CUSTOMER_ID'] = $this->id;
        }

        if ($this->number) {
            $array['CUSTOMER_NUMBER'] = $this->number;
        }

        if ($this->countryCode) {
            $array['COUNTRY_CODE'] = $this->countryCode;
        }

        if ($this->city) {
            $array['CITY'] = $this->city;
        }

        if ($this->term) {
            $array['TERM'] = $this->term;
        }

        return $array;
    }


    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }


}
