<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\Create;
use App\Http\Requests\Booking\Update;
use App\Service\BookingService;
use Illuminate\Http\Request;
use App\Http\Resources\Booking\resource as BookingResource;
use App\Http\Resources\Booking\collection as BookingCollection;

class BookingController extends Controller
{
    private $service;

    public function __construct(BookingService $bookingService)
    {
        $this->service = $bookingService;
    }

    public function index(Request $request)
    {
        $data = $this->service->collection($request->all());
        return new BookingCollection($data);
    }

    public function store(Create $request)
    {
        $data = $this->service->store($request->all());
        return new BookingResource($data);
    }

    public function show($id)
    {
        $data = $this->service->resource($id);
        return new BookingResource($data);
    }

    public function update(Update $request, $id)
    {
        $data = $this->service->update($request->all(), $id);
        return new BookingResource($data);
    }

    public function destroy($id)
    {
        $data = $this->service->destroy($id);
        return $data;
    }
}
