<?php

namespace App\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Monolog\Handler\ElasticaHandler;

class Etudiant extends Authenticatable
{
    use HasFactory;
    protected $table='etudiant';
    protected $primaryKey='id_etudiant';
    public $timestamps=false;
    public $incrementing = false; 

    protected $fillable=[
        'id_etudiant',
        'promo_id',
        'nom',
        'prenom',
        'semestre',
        'date_naissance',        
    ];

    
    public function nb_admis(){
        $credit=0;
        $etudiant= Etudiant::all();
        $semestre= Semestre::all();
        
        $note=new Note();
        $nb_admis=0;
        $nb_non_admis=0;
        $admis =[];
        foreach ($etudiant as $etu) {
            $credit=0;
            foreach ($semestre as $sem) {
                 $credit= $credit + $note->noteSemestre_etudiant($etu->id_etudiant,$sem->id_semestre)['credit_obtenu'];             
            if($credit ==(30*count($semestre))){
                $nb_admis++; 
                   
            }
           
            else $nb_non_admis=count($etudiant)-$nb_admis;
                
            }           
         }
        $resultat['admis'] = $nb_admis;
        $resultat['non_admis'] = $nb_non_admis;
        return $resultat;
            
        }

        public function liste(){
            
            $etudiant = Etudiant::all();
            $semestre = Semestre::all();
            
            $note = new Note();
            $admis = [];
            $non_admis = [];
            
            foreach ($etudiant as $etu) {
                $credit = 0;
                foreach ($semestre as $sem) {
                    $credit += $note->noteSemestre_etudiant($etu->id_etudiant, $sem->id_semestre)['credit_obtenu'];
                }
                
                // Vérifiez si l'étudiant a obtenu tous les crédits requis
                if ($credit == (30 * count($semestre))) {
                    $admis[] = $etu;  // Ajouter l'étudiant à la liste des admis
                } else {
                    $non_admis[] = $etu;  // Ajouter l'étudiant à la liste des non admis
                }
            }
            
            $resultat = [
                'admis' => $admis,
                'non_admis' => $non_admis,
                'nb_admis' => count($admis),
                'nb_non_admis' => count($non_admis)
            ];
            
            return $resultat;

            
        }
    }