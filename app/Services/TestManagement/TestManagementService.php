<?php

namespace App\Services\TestManagement;

class TestManagementService
{
    private $testModelsProxy;

    public function __construct(TestModelsProxy $testModelsProxy)
    {
        $this->testModelsProxy = $testModelsProxy;
    }

    public function getAll($page = 1, $limit = 10)
    {
        return $this->testModelsProxy->getAll();
    }
}
