<?php

namespace App\Http\Controllers;

use App\Models\Outservice;
use App\Traits\ReservationTrait;
use App\Http\Requests\Outservices\CreateOutServiceRequest;
use App\Http\Requests\Outservices\EditOutServiceRequest;
use Illuminate\Http\Request;

class OutserviceController extends Controller
{
    use ReservationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dates = ReservationTrait::getDates($request);

        $outservices = Outservice::whereDate('from_date', '>=', $dates->fromDate)
            ->whereDate('from_date', '<=', $dates->toDate)
            ->with('room')
            ->get();

        return view('outservice.index')
            ->with([
                'outservices' => $outservices,
                'dateRange' => $dates->dateRange
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outservice.create')
            ->with('title', 'Habitación en Mantenimiento - Crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOutServiceRequest $request)
    {
        $arrDateRange = explode(' - ', $request->get('dateRange'));

        $outservice = Outservice::create([
            'from_date'   => date('Y-m-d', strtotime($arrDateRange[0])),
            'to_date'     => date('Y-m-d', strtotime($arrDateRange[1])),
            'room_id'     => $request->get('room'),
            'description' => $request->get('description'),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('outservice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function show(Outservice $outservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Outservice $outservice)
    {
        $dateRangeFormat = date('d-m-Y', strtotime($outservice->from_date)) . ' - ' . date('d-m-Y', strtotime($outservice->to_date));

        return view('outservice.edit')
            ->with('title', 'Habitación en Mantenimiento - Editar')
            ->with('outservice', $outservice)
            ->with('dateRangeFormat', $dateRangeFormat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function update(EditOutServiceRequest $request, Outservice $outservice)
    {
        $arrDateRange = explode(' - ', $request->get('dateRange'));

        $outservice->update([
            'from_date'   => date('Y-m-d', strtotime($arrDateRange[0])),
            'to_date'     => date('Y-m-d', strtotime($arrDateRange[1])),
            'room_id'     => $request->get('room'),
            'description' => $request->get('description')
        ]);

        return redirect()->route('outservice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outservice  $outservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outservice $outservice)
    {
        $outservice->delete();

        return redirect()->route('outservice.index');
    }
}
