<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    # membuat method index
    public function index()
	{
        # menggunakan model Patients untuk select data
        $patients = Patients::all();

        # cek apakah data patients ada
        if($patients){
            $data = [
                'message' => 'Get all Patients',
                'data' => $patients
            ];
            # mengirim data (json) dan kode 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patients not found'
            ];

            return response()->json($data, 404);
        }
    }

    # membuat method index
    # menampilkan detail patient
    public function show($id)
	{
        $patient = Patients::find($id);
        # cek apakah data patients ada
        if($patient){
            $data = [
                'message' => 'Get detail Patients',
                'data' => $this->output([$patient])
            ];
            # mengirim data (json) dan kode 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patients not found'
            ];

            return response()->json($data, 404);
        }
    }

    # membuat method store
    # menambahkan data patient
    public function store(Request $request)
    {
        # Membuat validasi
        $validatedData = $request->validate([
            # kolom => 'rules|rules'
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'required'
        ]);

        # menggunakan model Patients untuk insert data
        $patient = Patients::create($validatedData);

        $data = [
            'message' => 'Patient is created succesfully',
            'data' => $patient
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }

    # membuat method update
    # mengupdate data patient
    public function update(Request $request, $id)
    {
        $patient = Patients::find($id);
        # cek apakah data patients ada
        if($patient){
            $patient->update([
                "name" => $request->name ? $request->name : $patient->name,
                "phone" => $request->phone ? $request->phone : $patient->phone,
                "address" => $request->address ? $request->address : $patient->address,
                "status" => $request->status ? $request->status : $patient->status,
                "in_date_at" => $request->in_date_at ? $request->in_date_at : $patient->in_date_at,
                "out_date_at" => $request->out_date_at ? $request->out_date_at : $patient->out_date_at
            ]);

            $data = [
                'message' => 'Patient is updated',
                'data' => $patient
            ];
            # mengirim data (json) dan kode 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patient not found'
            ];

            return response()->json($data, 404);       
        }
    }

    # membuat method destroy
    # menghapus data patient
    public function destroy($id)
    {
        $patient = Patients::find($id);
        # cek apakah data patients ada
        if($patient){
            # hapus patient tersebut
            $patient->delete();

            $data = [
                'message' => 'Patient is deleted'
            ];

            # mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patient not found'
            ];

            return response()->json($data, 404);
        }
    }
    # membuat method search
    # mencari nama patient
    public function search($name)
    {
        $patient = Patients::where('name', 'LIKE','%'.$name.'%')->get();
        # cek apakah data patients ada
        if($patient->isEmpty()){
            $data = [
                'message' => 'Patient not found'
            ];

            return response()->json($data, 404);
        } else {
            $data = [
                'message' => 'Get Patient Searched',
                'data' => $patient
            ];

            # mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        }
    }

    # membuat method positive
    # mencari data patient dengan status positif
    public function positive()
    {
        $patient = Patients::where("status", "positif")->get();

        $output = [
                "message" => "Get Patient Positive",
                "total" => count($patient),
                "data" => $patient
            ];

        return response()->json($output, 200);
    }

    # membuat method recovered
    # mencari data patient dengan status sembuh
    public function recovered()
    {
        $patient = Patients::where("status", "sembuh")->get();

        $data = [
                "message" => "Get Patient Recovered",
                "total" => count($patient),
                "data" => $patient
            ];

        return response()->json($data, 200);
    }

    # membuat method dead
    # mencari data patient dengan status meninggal
    public function dead()
    {
        $patient = Patients::where("status", "meninggal")->get();

        $data = [
                "message" => "Get Patient Dead",
                "total" => count($patient),
                "data" => $patient
            ];

        return response()->json($data, 200);
    }
}
