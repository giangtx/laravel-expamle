<?php

namespace App\Services\TestManagement;

use App\Models\Test;

class TestModelsProxy {
    public function getAll() {
        return Test::all();
    }
}
