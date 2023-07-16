<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\ApiController;
use App\Models\Test;
use App\Services\TestManagement\TestManagementService;
use Illuminate\Http\Request;

class TestController extends ApiController
{

    protected $testManagementService;

    public function __construct(TestManagementService $testManagementService)
    {
        $this->testManagementService = $testManagementService;
    }

    public function createTest(Request $request){
        $test = new Test();
        $test->name = $request->name;
        $test->test = $request->test;
        $test->save();
        return response()->json([
            'status' => self::STATUS_SUCCESS,
            'msg' => 'test created',
        ]);
    }

    public function test()
    {
        $test = $this->testManagementService->getAll();
        return response()->json([
            'status' => self::STATUS_SUCCESS,
            'msg' => 'test',
            'data' => $test,
        ]);
    }
}
