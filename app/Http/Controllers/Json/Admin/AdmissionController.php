<?php

namespace App\Http\Controllers\Json\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Utilities\Http\Response;
use Log;

use App\Models\Admission;
use App\Models\User\User;
use App\Models\Student;
use App\Models\Classes;

use Illuminate\Support\Facades\DB;

class AdmissionController extends Controller
{
  public function approve(Request $request, Admission $admission) 
  {
    try {
      if (isset($admission)) {
        DB::beginTransaction();
        $admission->status = 'approve';
        $admission->save();

        $classId = null;
        $className = null;
  
        if ($request->has('class_id')) {
          $classId = $request->class_id;
          $className = Classes::select('name')->where('id', $request->class_id)->first()->name;
        }

        /** create user for student */
        $user = User::create([
          'name' => $admission->name,
          'email' => $admission->email,
          'password' => Hash::make(str_replace('-','',$admission->date_of_birth)),
          'user_role_id' => 4, // user role student is 4
        ]);
        
        /** create student */
        $student = Student::create([
          'name' => $admission->name,
          'email' => $admission->email,
          'password' => str_replace('-','',$admission->date_of_birth),
          'nisn' => $admission->nisn,
          'gender' => $admission->gender,
          'user_id' => $user->id,
          'class_id' => $classId,
          'class_name' => $className,
          'place_of_birth' => $admission->place_of_birth,
          'date_of_birth' => $admission->date_of_birth,
          'parent_id' => $admission->parent_id,
        ]);

        DB::commit();
        return (new Response())->send();
      }
      return (new Response())->notFound()->send();
    } catch (\Throwable $th) {
      DB::rollback();
      Log::error($th->getMessage());
      Log::error($th->getTraceAsString());
      return (new Response())->badRequest()->send();
    }
  }

  public function unapprove(Admission $admission) 
  {
    if (isset($admission)) {
      $admission->status = 'unapprove';
      $admission->save();
      return (new Response())->send();
    }
    return (new Response())->notFound()->send();
  }
}