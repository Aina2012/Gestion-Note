<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    public function noteSemestre_etudiant($id_etudiant,$id_semestre)
    {
        
       $query =[];
       $notes = DB::table('v_note_final')
       ->where('id_etu', $id_etudiant)
       ->where('semestre_id', $id_semestre)
       ->get();
    
       $confuguration=DB::table('configurations')->get();
       
    //    dd($confuguration[0]->valeur);
   // Initialisation des variables
    $total_note = 0;
    $total_credit = 0;
    $somme_credit_obtenu = 0;
    $nb_matiere_inf_moyen = 0;
    $nb_matiere_echec = 0;

   // Parcours des notes
        foreach ($notes as $note) {
            $total_note += $note->note * $note->credit;
            $total_credit += $note->credit;
            
            $somme_credit_obtenu += $note->credit_obtenu;
            
            if ($note->note >= $confuguration[0]->valeur && $note->note < 10) {
                $nb_matiere_inf_moyen++;
            }

            if ($note->note < $confuguration[0]->valeur) {
                $nb_matiere_echec++;
            } 
        }
                
            $moyenne = $total_credit > 0 ? $total_note / $total_credit : 0;
            
            $resultat_status = 'Ajourne'; 
            if ($moyenne >= 10 && $nb_matiere_echec == 0 && $nb_matiere_inf_moyen <= 2) {
                $resultat_status = 'Admis'; 
            
            }
         
         
            //compesenser
            if ($moyenne >=10 && $nb_matiere_inf_moyen <=$confuguration[1]->valeur  && $note->note >= $confuguration[0]->valeur) {
                for ($i = 0; $i < count($notes) ; $i++)  {
                    $$somme_credit_obtenu=0;
                                if ( $notes[$i]->resultat === 'Aj' ) {
                                    $notes[$i]->resultat ='Comp.';
                                    $notes[$i]->credit_obtenu=$notes[$i]->credit;
                                    $somme_credit_obtenu += $notes[$i]->credit;
                                                            
                                }
                 }
            }
             
        
        $query ['id_etudiant']=$id_etudiant;
        $query ['note']=$notes;
        $query ['nom']=$notes[0]->nom;
        $query ['prenom']=$notes[0]->prenom;
        $query ['semestre']=$id_semestre;
        $query ['total_note']=$total_note;
        $query ['total_credit']=$total_credit;
        $query ['moyenne']=round($moyenne, 2);
        $query ['credit_obtenu']=$somme_credit_obtenu;
        $query ['resultat_status']=$resultat_status;
         
       return $query;
       
    }
    
    public function rattrapage($id_etudiant , $id_semestre){
        $note_atraper=6;
        $notes = DB::table('v_note_final')
        ->where('id_etu',$id_etudiant)
        ->where('semestre_id',$id_semestre)
        ->where('note'< $note_atraper)
        ->get()
        ;
        dd($notes);
        $resulat=[];
        $note=new Note();
        $note_semestre=$note->noteSemestre_etudiant($id_etudiant,$id_semestre);
        
        $resulat ['id_etudiant']=$id_etudiant;
        $resulat ['note']=$notes;
        $resulat ['nom']=$notes[0]->nom;
        $resulat ['prenom']=$notes[0]->prenom;
        $resulat ['semestre']=$id_semestre;
        $resulat ['total_note']=$note_semestre['total_note'];
        $resulat ['total_credit']=$note_semestre['total_credit'];
        $resulat ['moyenne']=round($note_semestre['moyenne'], 2);
        $resulat ['credit_obtenu']=$note_semestre['somme_credit_obtenu'];
        $resulat ['resultat_status']=$note_semestre['resultat_status'];
        
        return $resulat;
         

    }
    
}