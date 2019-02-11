<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function addItem(Request $request)
    {
        $rules = array(
                'NIK' => 'required|numeric',
                'Nama_Pegawai' => 'required|alpha_num',
                'ID_Unit' => 'required',
                'ID_Status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(

                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Data();
            $data->NIK = $request->NIK;
            $data->Nama_Pegawai = $request->Nama_Pegawai;
            $data->ID_Unit = $request->ID_Unit;
            $data->ID_Status = $request->ID_Status;
            
            $data->save();

            $response = new Data();
            $response->NIK = $request->NIK;
            $response->Nama_Pegawai = $request->Nama_Pegawai;
            $response->ID_Unit = $request->ID_Unit;
            $response->ID_Status = $request->ID_Status;
            $response->Nama_Unit = $data->unit->Nama_Unit;
            $response->Nama_Status = $data->status->Nama_Status;

            return response()->json($response);
        }
    }
    public function readItems(Request $req)
    {
        $data = Data::all();

        return view('welcome')->withData($data);
    }
    public function editItem(Request $req)
    {
        $data = Data::find($req->NIK);
        $data->Nama_Pegawai = $req->Nama;
        $data->ID_Unit = $req->Unit;
        $data->ID_Status = $req->Status;

        $data->save();

        $response = Data::find($req->NIK);
        $response->Nama_Pegawai = $req->Nama;
        $response->Nama_Unit = $data->unit->Nama_Unit;
        $response->Nama_Status = $data->status->Nama_Status;

        return response()->json($response);
    }
    public function deleteItem(Request $req)
    {
        Data::find($req->NIK)->delete();

        return response()->json();
    }
    public function searchItem(Request $req)
    {
      $output = '';
    if($req->Status != '')
      {
        $data = Data::where('ID_Status', '=', $req->Status)->get();
      }
    else{
       $data = Data::all(); 
    }
       
      

     $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        
        $output .= "
        <tr class='item".$row->NIK."'>
         <td>".$row->NIK."</td>
         <td>".$row->Nama_Pegawai."</td>
         <td>".$row->unit->Nama_Unit."</td>
         <td>".$row->status->Nama_Status."</td>
         <td><button class='edit-modal btn btn-info' data-nik='".$row->NIK."'
                            data-nama='".$row->Nama_Pegawai."' data-unit='".$row->ID_Unit."' data-status='".$row->ID_Status."'>
                            <span class='glyphicon glyphicon-edit'></span> Edit
                        </button>
                        <button class='delete-modal btn btn-danger'
                            data-nik='".$row->NIK."' data-nama='".$row->Nama_Pegawai."'>
                            <span class='glyphicon glyphicon-trash'></span> Delete
                        </button></td>
        </tr>
        ";
       }
      }
      else
      {
       $output = "
       <tr>
        <td align='center' colspan='5'>No Data Found</td>
       </tr>
       ";
      }

      return response()->json($output);

    }

}
