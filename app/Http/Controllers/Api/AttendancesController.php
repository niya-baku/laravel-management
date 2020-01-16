<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Attendance;
use App\Http\Resources\AttendanceResource;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    public function index()
    {
        $attendances = Attendance::latest()
            ->ignoreFlagged()  // *3
            ->paginate(20);
 
        return AttendanceResource::collection($attendances);
    }

    public function show(Attendance $attendance)
    {
        return new AttendanceResource($attendance);
    }
    
    public function store(Request $request)
    {
        $attendance = $this->validate( $request, [
            'name'  => 'required|min:3|max:50',
            'email' => 'required|email',
            'body'  => 'required|min:3',
        ] );
 
        $attendance = Attendance::create($attendance);
 
        return new AttendanceResource($attendance);
    }
}
