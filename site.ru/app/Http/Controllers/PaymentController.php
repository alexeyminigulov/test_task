<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Payment;
use App\Profession;
use App\Worker;
use Validator;
use App\Business\DatePayment;
use App\Business\CollectionModels;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( $request->all() );
        $validator = Validator::make($request->all(), [
            'date'      => 'required|date',
            'profession'=> 'required|integer|exists:professions,id',
            'premium'   => 'required|integer|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json([ "status" => 500 ]);
        }

        $date = $request->input('date');
        $dateForPayment = new DatePayment( $date );

        $profession     = Profession::find( $request->input('profession') );
        $workers        = $profession->workers;
        $workersId      = CollectionModels::getArrayByKey( $workers, 'id' );
        
        // Сотрудники с указанной профессией у каторых уже есть премия
        $paymentWorkers = Payment::getMonth( $dateForPayment->getMonth(), $dateForPayment->getYear() )
                        ->getWorker($workersId)->get();
        unset($workersId);
        
        if( count($workers) === count($paymentWorkers) ) {
            return response()->json([ "status" => 500, 
                        "msg" => "По профессии '". $profession->name ."' премия уже была назначена всем!" 
                    ]);
        }

        $workers = CollectionModels::deleteDiff($paymentWorkers, $workers);

        $workers = CollectionModels::addField($workers, 'profession', $profession->name);
        $workers = CollectionModels::changeField($workers, 'salary', 'add', $request->input('premium') );

        if( !CollectionModels::pushDBCollectionWithModel('App\Payment', $workers, $request) )
        {
            return response()->json([ "status" => 500, 
                        "msg" => "Неудачная попытка сохранить записи в БД!" 
                    ]);
        }

        return response()->json([
                                'status'    => 200,
                                'date'      => $request->input('date'),
                                'premium'   => $request->input('premium'),
                                'workers'   => $workers,
                                ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
