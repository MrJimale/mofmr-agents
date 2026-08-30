<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminAgentController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/


// Home
Route::get('/', function () {
    return redirect()->route('agent.create');
});


// Agent Registration
Route::get('/register-agent', [AgentController::class, 'create'])
    ->name('agent.create');

Route::post('/register-agent', [AgentController::class, 'store'])
    ->name('agent.store');


// Track Application - Public
Route::get('/track-application', function () {
    return view('application.track');
})->name('application.track');


// Track Application - Submit Code
Route::post('/track-application', function (\Illuminate\Http\Request $request) {

    $request->validate([
        'tracking_code' => 'required|string',
    ]);

    $agent = \App\Models\Agent::where(
        'tracking_code',
        strtoupper(trim($request->tracking_code))
    )->first();

    if (!$agent) {

        return back()
            ->withInput()
            ->with('error', 'Application not found. Please check your tracking code.');

    }

    return view('application.track', compact('agent'));

})->name('application.track.check');



/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/


// Login Page
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');


// Login
Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('login.authenticate');



/*
|--------------------------------------------------------------------------
| PROTECTED ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {


    // Dashboard

    Route::get('/', [AdminAgentController::class, 'dashboard'])
        ->name('admin.dashboard');


    // Applications

    Route::get('/agents', [AdminAgentController::class, 'index'])
        ->name('admin.agents');


    // Review Application

    Route::get('/agents/{agent}', [AdminAgentController::class, 'show'])
        ->name('admin.agents.show');


    // Approve

    Route::post('/agents/{agent}/approve', [AdminAgentController::class, 'approve'])
        ->name('admin.agents.approve');


    // Send Back

    Route::post('/agents/{agent}/send-back', [AdminAgentController::class, 'sendBack'])
        ->name('admin.agents.send-back');


    // Deny

    Route::post('/agents/{agent}/deny', [AdminAgentController::class, 'deny'])
        ->name('admin.agents.deny');


    // Approved Agents

    Route::get('/approved-agents', [AdminAgentController::class, 'approved'])
        ->name('admin.approved');


    // Certificate

    Route::get('/agents/{agent}/certificate', [AdminAgentController::class, 'certificate'])
        ->name('admin.certificate');


    // ID Card

    Route::get('/agents/{agent}/id-card', [AdminAgentController::class, 'idCard'])
        ->name('admin.id-card');


    // Logout

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');

});