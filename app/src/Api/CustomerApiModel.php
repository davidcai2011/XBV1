<?php

namespace App\Api;

class CustomerApiModel
{
    public $id;

    public $customerName;

    public $company;

    private $links = [];

    public function addLink($ref, $url)
    {
        $this->links[$ref] = $url;
    }

    public function getLinks()
    {
        return $this->links;
    }
}