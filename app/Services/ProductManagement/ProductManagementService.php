<?php

namespace App\Services\ProductManagement;

class ProductManagementService
{
    protected $productModelsProxy;

    public function __construct(ProductModelsProxy $productModelsProxy)
    {
        $this->productModelsProxy = $productModelsProxy;
    }

    public function getAll($page = 1, $limit = 10, $name = '')
    {
        return $this->productModelsProxy->getAll($page, $limit, $name);
    }

    public function create($data)
    {
        return $this->productModelsProxy->create($data);
    }

    public function update($data)
    {
        return $this->productModelsProxy->update($data);
    }
}
