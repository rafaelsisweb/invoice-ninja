<?php namespace App\Ninja\Import;

use Utils;
use DateTime;
use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    protected $maps;

    public function __construct($maps)
    {
        $this->maps = $maps;
    }

    protected function hasClient($name)
    {
        $name = strtolower($name);
        return isset($this->maps[ENTITY_CLIENT][$name]);
    }

    protected function getClientId($name)
    {
        $name = strtolower($name);
        return isset($this->maps[ENTITY_CLIENT][$name]) ? $this->maps[ENTITY_CLIENT][$name] : null;
    }

    protected function getCountryId($name)
    {
        $name = strtolower($name);
        return isset($this->maps['countries'][$name]) ? $this->maps['countries'][$name] : null;
    }

    protected function getFirstName($name)
    {
        $name = Utils::splitName($name);
        return $name[0];
    }

    protected function getDate($date, $format = 'Y-m-d')
    {
        $date = DateTime::createFromFormat($format, $date);
        return $date ? $date->format('Y-m-d') : null;
    }

    protected function getLastName($name)
    {
        $name = Utils::splitName($name);
        return $name[1];
    }

    protected function hasInvoice($invoiceNumber)
    {
        $invoiceNumber = strtolower($invoiceNumber);
        return isset($this->maps[ENTITY_INVOICE][$invoiceNumber]);
    }

}