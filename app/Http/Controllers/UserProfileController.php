<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function getdata()
    {
        $result = [];
        $result['status'] = false;
        $result['message'] = "something error";

        $data = User::get();
        $result['data'] = $data;

        $result['status'] = true;
        $result['message'] = "suksess";

        return response()->json($result);
    }

    public function showdata($id)
    {
        $result = [];
        $result['status'] = false;
        $result['message'] = "something error";

        $data = User::find($id);
        $result['data'] = $data;

        $result['status'] = true;
        $result['message'] = "suksess";

        return response()->json($result);
    }

    public function adddata(Request $r)
    {
        $result = [];
        $result['status'] = false;
        $result['message'] = "something error";

        $users = new User;

        if ($r->hasFile('images')) {
            $file = $r->file('images');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/profilephoto_images', $name);
            $images = $name;
        } else {
            $images = $r->images;
        }

        $users->images = $images;
        $users->staff_id = $r->staff_id;
        $users->name = $r->name;
        $users->email = $r->email;
        $users->password = bcrypt($r->get('password'));
        $users->gender = $r->gender;
        $users->department = $r->department;
        $users->phonenumber = $r->phonenumber;
        $users->company_name = $r->company_name;

        $users->save();

        $result['data'] = $users;
        $result['status'] = true;
        $result['message'] = "suksess add data";

        return response()->json($result);
    }

    public function deleteuser(Request $r)
    {
        $result = [];
        $result['status'] = false;
        $result['message'] = "something error";

        $users = User::find($r->id);
        $users->delete();

        // $result['data'] = $users ;
        $result['status'] = true;
        $result['message'] = "suksess delete data";

        return response()->json($result);
    }

    public function updateuser(Request $r)
    {
        $result = [];
        $result['status'] = false;
        $result['message'] = "something error";

        $users = User::findOrFail($r->id);
        $images = null;

        if ($r->hasFile('images')) {
            $file = $r->file('images');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/profilephoto_images', $name);
            $images = $name;
        } else {
            $images = $r->images;
        }

        $users->images = $images;
        $users->staff_id = $r->staff_id;
        $users->name = $r->name;
        $users->email = $r->email;
        $users->password = bcrypt($r->get('password'));
        $users->gender = $r->gender;
        $users->department = $r->department;
        $users->phonenumber = $r->phonenumber;
        $users->company_name = $r->company_name;
        $users->save();

        $result['data'] = $users;
        $result['status'] = true;
        $result['message'] = "suksess add data";

        return response()->json($result);
    }

    public function userClockIn(Request $r)
    {
        $result = [];
        $result['status'] = false;
        $result['message'] = "something error";

        $users = User::where('staff_id', $r->staff_id)->first();

        $mytime = Carbon::now();
        $time = $mytime->format('H:i:s');
        $date = $mytime->format('Y-m-d');

        $users->date_CheckIn = $date;
        $users->time_CheckIn = $time;
        $users->location_CheckIn = $r->location_CheckIn;

        $users->save();

        $result['data'] = $users;
        $result['status'] = true;
        $result['message'] = "suksess add data";

        return response()->json($result);
    }

    public function userClockOut(Request $r)
    {
        $result = [];
        $result['status'] = false;
        $result['message'] = "something error";

        $users = User::findOrFail($r->staff_id);

        $users->staff_id = $r->staff_id;
        $users->time_CheckOut = $r->time_CheckOut;
        $users->location_CheckOut = $r->location_CheckOut;

        $users->save();

        $result['data'] = $users;
        $result['status'] = true;
        $result['message'] = "suksess add data";

        return response()->json($result);
    }
}
