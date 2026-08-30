<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function create()
    {
        return view('agent.register');
    }


    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'phone' => 'required',

            'email' => 'nullable|email',

            'address' => 'required',

            'region' => 'required',

            'city' => 'required',

            'country' => 'required',

            'photo' => 'nullable|image|max:2048',

            'tin' => 'required|file|max:5120',

            'business_license' => 'required|file|max:5120',

            'company_profile' => 'required|file|max:5120',

            'account_number' => 'required|file|max:5120',

            'fisheries_license' => 'required|file|max:5120',

            'national_id' => 'required|file|max:5120',

        ]);


        /*
        |--------------------------------------------------------------------------
        | CREATE AGENT
        |--------------------------------------------------------------------------
        */

        $agent = new Agent();


        /*
        |--------------------------------------------------------------------------
        | GENERATE TRACKING CODE
        |--------------------------------------------------------------------------
        */

        $agent->tracking_code =
            'MFMR-' .
            date('Y') .
            '-' .
            strtoupper(
                substr(
                    str_shuffle(
                        'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'
                    ),
                    0,
                    6
                )
            );


        /*
        |--------------------------------------------------------------------------
        | AGENT INFORMATION
        |--------------------------------------------------------------------------
        */

        $agent->name = $request->name;

        $agent->phone = $request->phone;

        $agent->email = $request->email;

        $agent->address = $request->address;

        $agent->region = $request->region;

        $agent->city = $request->city;

        $agent->country = $request->country;

        $agent->status = 'pending';


        /*
        |--------------------------------------------------------------------------
        | PHOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $agent->photo =
                $request
                    ->file('photo')
                    ->store('agents/photos', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | SAVE AGENT
        |--------------------------------------------------------------------------
        */

        $agent->save();


        /*
        |--------------------------------------------------------------------------
        | DOCUMENTS
        |--------------------------------------------------------------------------
        */

        $documents = [

            'tin' => 'TIN Number',

            'business_license' => 'Business License',

            'company_profile' => 'Company Profile',

            'account_number' => 'Account Number',

            'fisheries_license' => 'Fisheries / Marine License',

            'national_id' => 'National ID / Registration Document',

        ];


        foreach ($documents as $field => $type) {

            $file = $request->file($field);


            $path =
                $file->store(
                    'agents/documents',
                    'public'
                );


            $agent->documents()->create([

                'document_type' => $type,

                'file_name' =>
                    $file->getClientOriginalName(),

                'file_path' => $path,

                'status' => 'pending',

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect('/register-agent')

            ->with(
                'success',
                'Agent registration submitted successfully.'
            )

            ->with(
                'tracking_code',
                $agent->tracking_code
            );
    }
}