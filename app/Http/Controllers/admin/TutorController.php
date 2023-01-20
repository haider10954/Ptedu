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

    function upload_files($file)
    {
        if(!file_exists(storage_path('app/public/tutor')))
        {
            mkdir(storage_path('app/public/tutor'),0755);
        }
        $fileName =  time() . mt_rand(300, 9000) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/tutor', $fileName);
        $loadPath = storage_path('app/public/') . '/' . $fileName;
        return $fileName;
    }

    public function add_tutor(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'en_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|min:8',
            'job' => 'required',
            'address' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);
        $tutor_img = $this->upload_files($request['image']);
        $tutor = Tutor::create([
            'name' => $request['name'],
            'english_name' => $request['en_name'],
            'email' => $request['email'],
            'mobile_number' => $request['phone_number'],
            'job' => $request['job'],
            'address' => $request['address'],
            'description' => $request['description'],
            'tutor_img' => $tutor_img,
        ]);

        if ($tutor) {
            return redirect()->route('tutor');
        } else {
            return redirect()->back()->with('msg', 'Something went wrong Please try again.');
        }
    }

    public function delete_tutor(Request $request)
    {
        $tutor = Tutor::where('id', $request->id)->first();
        $filePath = storage_path('app/public/tutor/' . $tutor->tutor_img);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
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
            'address' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
        ]);


        $data = [
            'name' => $request['name'],
            'english_name' => $request['en_name'],
            'email' => $request['email'],
            'mobile_number' => $request['phone_number'],
            'job' => $request['job'],
            'address' => $request['address'],
            'description' => $request['description'],
        ];

        if ($request->hasFile('image')) {
            $data['tutor_img'] = $this->upload_files($request['image']);
        }

        $tutor = Tutor::where('id', $request['id'])->update($data);
        if ($tutor) {
            return redirect()->route('tutor');
        } else {
            return redirect()->back()->with('error', 'Something went wrong Please try again.');
        }
    }
}
