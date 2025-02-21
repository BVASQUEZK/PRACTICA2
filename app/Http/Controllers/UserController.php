<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = $request->get('texto', '');
        $registros = User::where('name', 'LIKE', "%$texto%")
                        ->orWhere('email', 'LIKE', "%$texto%")
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        return view('usuario.index', compact('registros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            DB::beginTransaction();
            $registro = new User();
            $registro->name = $request->input('name');
            $registro->email = $request->input('email');
            $registro->password = Hash::make($request->input('password'));
            $registro->save();
            DB::commit();

            return redirect()->route('usuario.index')->with('mensaje', 'Usuario ' . $registro->name . ' creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('usuario.index')->with('error', 'Error al crear el usuario.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuario.edit', compact('usuario'));
    }
    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $registro = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            DB::beginTransaction();
            $registro->name = $request->input('name');
            $registro->email = $request->input('email');

            if ($request->filled('password')) {
                $registro->password = Hash::make($request->input('password'));
            }

            $registro->save();
            DB::commit();

            return redirect()->route('usuario.index')->with('mensaje', 'Usuario ' . $registro->name . ' actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('usuario.index')->with('error', 'Error al actualizar el usuario.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $registro = User::findOrFail($id);
            $registro->delete();
            return redirect()->route('usuario.index')->with('mensaje', 'Usuario ' . $registro->name . ' eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('usuario.index')->with('error', 'No se puede eliminar el usuario ' . $registro->name . ' porque está en uso.');
        } catch (\Exception $e) {
            return redirect()->route('usuario.index')->with('error', 'Ocurrió un error al intentar eliminar el usuario.');
        }
    }
}
