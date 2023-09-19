<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResource;
use App\Models\SliderMainPage;
use Illuminate\Http\Request;

class SliderMainPageController extends Controller
{
    public function index()
    {
        $sliders = SliderMainPage::query()->get();
        return new ApiResource($sliders);
    }
}
