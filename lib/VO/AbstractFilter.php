<?php


namespace Fastbill\VO;


abstract class AbstractFilter
{
    /** @var int */
    private $limit;

    /** @var int */
    private $offset;

    public function toArray()
    {
        $array = array(
            'FILTER' => $this->getFilterArray()
        );

        if ($this->limit) {
            $array['LIMIT'] = $this->limit;
        }

        if ($this->offset) {
            $array['OFFSET'] = $this->offset;
        }

        return $array;
    }

    abstract protected function getFilterArray();

    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }


}
