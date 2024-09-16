<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Footnote\Node\FootnoteRef;

class NoteController extends Controller
{
                    // public function resulat_semestre($id_etudiant, $id_semestre) {
                    //     // Requête pour obtenir les notes du semestre
                    //     $notes = DB::table('v_note_semestre')
                    //         ->where('id_etudiant', $id_etudiant)
                    //         ->where('semestre_id', $id_semestre)
                    //         ->get();
                    
                    //     // Initialisation des variables
                    //     $total_note = 0;
                    //     $total_credit = 0;
                    //     $somme_credit_obtenu = 0;
                    //     $nb_matiere_inf_moyen = 0;
                    //     $nb_matiere_echec = 0;
                    
                    //     // Parcours des notes
                    //     foreach ($notes as $note) {
                    //         $total_note += $note->note * $note->credit;
                    //         $total_credit += $note->credit;
                    //         $somme_credit_obtenu += $note->credit_obtenu;
                    
                    //         if ($note->note >= 6 && $note->note < 10) {
                    //             $nb_matiere_inf_moyen++;
                    //         }
                    
                    //         if ($note->note < 6) {
                    //             $nb_matiere_echec++;
                    //         }
                    //     }
                    
                    //     // Calcul de la moyenne
                    //     $moyenne = $total_credit > 0 ? $total_note / $total_credit : 0;
                    
                    //     // Mise à jour des résultats si les conditions sont remplies
                    //     if ($moyenne > 10 && $nb_matiere_echec == 0 && $nb_matiere_inf_moyen <= 2) {
                    //         foreach ($notes as $note) {
                    //             if ($note->resultat == 'Aj') {
                    //                 $note->resultat = 'Comp';
                    //                 $note->credit_obtenu = $note->credit;
                    //             }
                    //             $somme_credit_obtenu += $note->credit_obtenu;
                    //         }
                    //     }
                    
                    //     // Retourne la vue avec les données calculées
                    //     return view('admin.note', [
                    //         'etudiant' => $id_etudiant,
                    //         'resultat' => $notes,
                    //         'semestre' => $id_semestre,
                    //         'moyenne' => round($moyenne, 2),
                    //         'credit' => $somme_credit_obtenu
                    //     ]);
                    // }

    public function index(){
    $matier=DB::table('matiere');
    return view('admin.note');
}

 public function ajouter_note(Request $request){
    $request->validate([
        'etudiant'=>'required',
        'matiere_id'=>'required',
        'resultat'=>'required',
        'date_saisie'=>'required',
    ]);
    
    $id_etudiant=DB::table('etudiant')->where('id_etudiant',$request->etudiant)->first();
    if(!$id_etudiant){
        $etu=DB::table('etudiant')->insertGetId([
            'id_types'=>$request->etudiant,
        ]);
    }
    else{
        $etu=$id_etudiant->id_etudiant;           
    }

    $matiere_id=DB::table('matiere')->where('id_matiere',$request->matiere_id)->first();
    if(!$matiere_id){
        $mat=DB::table('matiere')->insertGetId([
            'id_types'=>$request->matiere_id,
        ]);
    }
    else{
        $mat=$matiere_id->id_matiere;           
    }

      Note::create([
        'id_etu'=>$etu,
        'matiere_id'=>$mat,
        'resultat'=>$request->resultat,
        'date_saisie'=>$request->date_saisie,
        
      ]);  
 }

 public function annee($id_etudiant){
   
    return view('admin.semestre_anne', compact('id_etudiant' ) );
}

public function semestre_anne($id_etudiant,$anne = null){
     
    $semestre = [];
    if ($anne == 'L1') {
        $semestre = [1, 2];
    } elseif ($anne == 'L2') {
        $semestre = [3, 4];
    } elseif ($anne == 'L3') {
        $semestre = [5, 6];
    }
   
    $notes=[];
    $note= new Note();
    for ($i=0; $i <count($semestre) ; $i++) { 
        $notes[$i]=$note->noteSemestre_etudiant($id_etudiant,$semestre[$i]); 
        
    }
       
    $moyenne_generale = 0;

    if ($notes && count($notes) >= 2) {
        if (isset($notes[0]['moyenne']) && isset($notes[1]['moyenne'])) {
            $moyenne_generale = ($notes[0]['moyenne'] + $notes[1]['moyenne']) / 2;
        }
    } else {
        dd("tsy mety e");
    }

    $status='Ajourne';
    if ($notes[0]['credit_obtenu']==30 &&  $notes[1]['credit_obtenu']==30) {
    $status='Admin';
    }

    $credit_general=($notes[0]['credit_obtenu'] + $notes[1]['credit_obtenu'])/2;
       
           
        return view('admin.note_anne', [
            'etudiant' => $id_etudiant,
            'notes'=>$notes,
            'nom' =>$notes[0]['nom'],         
            'prenom' =>$notes[0]['prenom'],   
            'moyenne_generale'=>$moyenne_generale,
            'status'=>$status,
            'credit_general'=>$credit_general       
        ]);
}
                    
}