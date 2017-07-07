<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\CBRAgent;
use App\Business\DatePayment;
use App\Business\Photo;
use App\Http\Requests;
use App\Worker;
use App\Profession;
use App\Payment;
use Validator;
use DB;


class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date = null)
    {
        $date = ($date == null) ? date('Y-m-d') : $date;

        $dateForPayment = new DatePayment( $date );

        $professions = Profession::all();

        $cbr = new CBRAgent();
        if ($cbr->load()){    
            $usd_curs = $cbr->get('USD');
        }

        $payment = Payment::getMonth( $dateForPayment->getMonth(), $dateForPayment->getYear() )
                        ->paginate(10);

        return view('welcome', ['payment'       => $payment,
                                'professions'   => $professions,
                                'usd_curs'      => $usd_curs,
                                'currentDate'   => $dateForPayment->getDate()
                                ]);
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|alpha|max:255',
            'lastName'  => 'required|alpha|max:255',
            'position'  => 'required|integer|exists:professions,id',
            'salary'    => 'required|integer|min:0',
            'img'       => 'required|image|dimensions:min_width=400,min_height=400',
        ]);
        if ($validator->fails()) {
            return response()->json([ "status" => 500 ]);
        }

        $fileImg = $request->file('img');
        $photo = new Photo( $fileImg );
        $photo->save();
        $fileName = $photo->getSource();

        $worker = Worker::create([
            'first_name'    => $request->input('firstName'),
            'last_name'     => $request->input('lastName'),
            'profession_id' => $request->input('position'),
            'salary'        => $request->input('salary'),
            'photo'         => $fileName,
        ]);

        return response()->json([ "status" => 200, "worker" => $worker ]);
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
