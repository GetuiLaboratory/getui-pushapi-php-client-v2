<?php
class GTCondition extends GTApiRequest{
    private $key;
    private $values;
    private $opt_type;

    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
        $this->apiParam["key"] = $key;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setValues($values)
    {
        $this->values = $values;
    }

    public function getOptType()
    {
        return $this->opt_type;
    }

    public function setOptType($opt_type)
    {
        $this->opt_type = $opt_type;
        $this->apiParam["opt_type"] = $opt_type;
    }

    public function getApiParam()
    {
        if ($this->values != null){
            $this->apiParam["values"] = $this->values;
        }
        return $this->apiParam;
    }
}