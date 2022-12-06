<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function tutor_listing()
    {
        $tutor = Tutor::paginate(10);
        return view('admin.tutor.tutor', compact('tutor'));
    }

    public function edit_tutor_view($id)
    {
        $tutor = Tutor::where('id', $id)->first();
        return view('admin.tutor.edit_tutor', compact('tutor'));
    }

    public function add_tutor(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|min:8',
            'job' => 'required',
            'address' => 'required'
        ]);

        $tutor = Tutor::create([
            'name' => $request['name'],
            'english_name' => $request['en_name'],
            'email' => $request['email'],
            'mobile_number' => $request['phone_number'],
            'job' => $request['job'],
            'address' => $request['address']
        ]);

        if ($tutor) {
            return redirect()->route('tutor');
        } else {
            return redirect()->back()->with('msg', 'Something went wrong Please try again.');
        }
    }

    public function delete_tutor(Request $request)
    {
        $tutor = Tutor::where('id', $request['id'])->delete();
        if ($tutor) {
            return redirect()->back()->with('msg', 'Tutor has been deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }

    public function edit_tutor(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|min:8',
            'job' => 'required',
            'address' => 'required'
        ]);

        $tutor = Tutor::where('id', $request['id'])->update([
            'name' => $request['name'],
            'english_name' => $request['en_name'],
            'email' => $request['email'],
            'mobile_number' => $request['phone_number'],
            'job' => $request['job'],
            'address' => $request['address'],
        ]);
        if ($tutor) {
            return redirect()->route('tutor');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }
}
