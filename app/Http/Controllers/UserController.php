<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User;

class UserController extends Controller
{

    public function getAll(){
      $data = User::get();
      return response()->json($data, 200);
    }

    public function create(Request $request){
        $user= new User();
        $user_existe = User::where('usuario',$request->usuario)->first();
        if($user_existe){
            return response()->json(['error' => 'existe'], 422);
        }
        $user->create($request->all());
        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
    }

    public function delete($id){
      $res = User::find($id)->delete();
      return response()->json([
          'message' => "Successfully deleted",
          'success' => true
      ], 200);
    }

    public function get($id){
      $data = User::find($id);
      return response()->json($data, 200);
    }

    public function update(Request $request,$id){
        $data['usuario'] = $request['usuario'];
        $data['nombres'] = $request['nombres'];
        $data['apellidos'] = $request['apellidos'];
        $data['tipoDeIdentificacion'] = $request['tipoDeIdentificacion'];
        $data['NumDeIdentificacion'] = $request['NumDeIdentificacion'];
        $data['fechaDeNacimiento'] = $request['fechaDeNacimiento'];
        $data['contrasenna'] = $request['contrasenna'];
        $user_existe = User::where('usuario',$request->usuario)->where('id','!=',$request->id)->first();
        if($user_existe){
            return response()->json(['error' => 'existe'], 422);
        }
        User::find($id)->update($data);

      return response()->json([
          'message' => "Successfully updated",
          'success' => true
      ], 200);
    }
}
