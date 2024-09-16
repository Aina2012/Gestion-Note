<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Http\Requests\LoginEtu;
use App\Models\Semestre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
  

    public function doLoginEtu(LoginEtu $request)
    {
        $credentials = $request->validated();
        $etudiant= Etudiant::where('id_etudiant', $credentials['numero'])->first();  
        if ($etudiant) {
                
            return redirect()->route('semestre.etu', ['id_etudiant' => $etudiant]);
        } else {
            return back()->withErrors(['etudiant' => 'No student found'])->onlyInput('numero');
        }

    }

    public function noteEtu($id_etudiant){
        $semestre = Semestre::all();
        $note= new Note();
       
    $etudiant = Etudiant::find($id_etudiant);
    for ($i=0; $i <count($semestre) ; $i++) { 
        $semestre[$i]['moyenne']=$note->noteSemestre_etudiant($id_etudiant,$semestre[$i]->id_semestre)['moyenne'];
        $semestre[$i]['resultat_status']=$note->noteSemestre_etudiant($id_etudiant,$semestre[$i]->id_semestre)['resultat_status'];
    }

    return view('etudiant.semestre', [
        'semestre' => $semestre,
        'etudiant' => $etudiant,
        'id_etudiant' => $id_etudiant, // Passer id_etudiant à la vue
    ]);
    }

   
    public function resultat_semestre_etu($id_etudiant, $id_semestre) {
        $note=new Note();
        $semestre_note= $note->noteSemestre_etudiant($id_etudiant,$id_semestre);
         
        return view('etudiant.note_semestre_etu', [
            'etudiant' => $id_etudiant,
            'nom' => $semestre_note['nom'],
            'prenom' => $semestre_note['prenom'],
            'resultat' => $semestre_note['note'],
            'semestre' => $id_semestre,
            'total_note' => $semestre_note['total_note'],
            'total_credit' => $semestre_note['total_credit'],
            'moyenne' => $semestre_note['moyenne'],
            'credit' => $semestre_note['credit_obtenu'],
            'resultat_status' => $semestre_note['resultat_status'],
        ]);
    }

}