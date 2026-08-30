<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW REGISTRATION FORM
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('agent.register');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE APPLICATION
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name' => 'required|string|max:255',

            'phone' => 'required|string|max:255',

            'email' => 'nullable|email|max:255',

            'address' => 'required|string|max:255',

            'region' => 'required|string|max:255',

            'city' => 'required|string|max:255',

            'country' => 'required|string|max:255',

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
        | GENERATE UNIQUE TRACKING CODE
        |--------------------------------------------------------------------------
        */

        do {

            $trackingCode =
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

        } while (
            Agent::where(
                'tracking_code',
                $trackingCode
            )->exists()
        );


        $agent->tracking_code = $trackingCode;


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
        | AGENT PHOTO
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | The photo is now stored on the PRIVATE disk.
        |
        */

        if ($request->hasFile('photo')) {

            $agent->photo =
                $request
                    ->file('photo')
                    ->store(
                        'agents/photos',
                        'private'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | SAVE AGENT
        |--------------------------------------------------------------------------
        */

        $agent->save();


        /*
        |--------------------------------------------------------------------------
        | REQUIRED DOCUMENTS
        |--------------------------------------------------------------------------
        */

        $documents = [

            'tin' =>
                'TIN Number',

            'business_license' =>
                'Business License',

            'company_profile' =>
                'Company Profile',

            'account_number' =>
                'Account Number',

            'fisheries_license' =>
                'Fisheries / Marine License',

            'national_id' =>
                'National ID / Registration Document',

        ];


        /*
        |--------------------------------------------------------------------------
        | STORE DOCUMENTS
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | All documents are stored on the PRIVATE disk.
        |
        */

        foreach ($documents as $field => $type) {

            $file = $request->file($field);


            $path =
                $file->store(
                    'agents/documents',
                    'private'
                );


            $agent->documents()->create([

                'document_type' =>
                    $type,

                'file_name' =>
                    $file->getClientOriginalName(),

                'file_path' =>
                    $path,

                'status' =>
                    'pending',

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN SUCCESS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('agent.create')
            ->with(
                'success',
                'Your application has been submitted successfully.'
            )
            ->with(
                'tracking_code',
                $agent->tracking_code
            );
    }
}