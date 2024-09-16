
CREATE or replace view V_note_etudiant as

SELECT 
    r.id_etu,etu.nom, etu.prenom,
    r.matiere_id,mat.code_matiere,mat.nom_matiere,
    credit,
    sa.goupe,
    sa.semestre_id,
    max(resultat) as note,
      CASE 
            WHEN max(resultat)  < 10 THEN 0
            ELSE mat.credit
        END AS credit_obtenu  
from 
(
    select
    id_etu, matiere_id ,resultat
    from note n
    UNION 
    select
     e.id_etudiant  ,matier_id ,0 as resultat 
    from semestre_matiere sm 
    cross JOIN etudiant e
    
) as r
join etudiant etu on r.id_etu=etu.id_etudiant
join matiere mat on r.matiere_id=mat.id_matiere
join semestre_matiere sa on r.matiere_id=sa.matier_id

GROUP BY 
    matiere_id ,code_matiere,nom_matiere,credit,
    id_etu,nom,prenom, goupe,semestre_id
ORDER BY id_etu
;


SELECT  
    id_etu,
    semestre_id,
    goupe,
    code_matiere,
    credit,
    note 
from V_note_etudiant 
WHERE goupe <>-1
;

WITH max_note_optionel as (
SELECT 
    id_etu,
    semestre_id,
    goupe,
    max(note) as note
from V_note_etudiant 

GROUP BY
id_etu,
    semestre_id,
    goupe   
),
note_optionel_with_doublon as
(SELECT 
    vne.id_etu,
    vne.semestre_id,
    vne.matiere_id,
    vne.goupe,
    vne.note
FROM V_note_etudiant  vne 
JOIN max_note_optionel mno 
on vne.id_etu=mno.id_etu 
and vne.semestre_id=mno.semestre_id 
and vne.goupe=mno.goupe 
and vne.note=mno.note
WHERE vne.goupe <>-1)
SELECT DISTINCT on (id_etu,semestre_id,goupe)
id_etu,
semestre_id,
matiere_id,
goupe,
note
from note_optionel_with_doublon 
;




CREATE or replace view V_note_final as
WITH max_note_optionel as (
SELECT 
    id_etu,
    semestre_id,
    goupe,
    max(note) as note
from V_note_etudiant 
GROUP BY
id_etu,
    semestre_id,
    goupe   
),
 note_optionel_with_doublon as 

(SELECT 
     DISTINCT on(vne.id_etu,vne.semestre_id,vne.goupe)   
    vne.id_etu,
    vne.semestre_id,
    vne.goupe,
    vne.matiere_id,
    vne.note
FROM V_note_etudiant  vne 

JOIN max_note_optionel mno 
on vne.id_etu=mno.id_etu 
and vne.semestre_id=mno.semestre_id 
and vne.goupe=mno.goupe 
and vne.note=mno.note
WHERE vne.goupe <>-1) 

SELECT 
   vno.id_etu ,
   vno.nom , 
   vno.prenom,
   vno.matiere_id,
   vno.nom_matiere,
   vno.code_matiere,
   vno.semestre_id,
   vno.goupe,
   vno.credit ,
   vno.credit_obtenu ,
   vno.note,
    CASE
        WHEN vno.note < 10 THEN 'Aj'
        WHEN vno.note >= 10 AND vno.note < 12 THEN 'P'
        WHEN vno.note >= 12 AND vno.note < 15 THEN 'AB'
        WHEN vno.note >= 15 AND vno.note < 17 THEN 'B'
        WHEN vno.note >= 17 THEN 'TB'
    END AS resultat

from V_note_etudiant vno 
 left join note_optionel_with_doublon ndb 
 on ndb.id_etu=vno.id_etu 
 and vno.matiere_id=ndb.matiere_id 
WHERE vno.goupe = -1 or vno.matiere_id=ndb.matiere_id 

;




