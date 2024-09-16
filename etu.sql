create database etu;
\c etu

create table promotion(
    id_prom serial primary key,
    promotion VARCHAR(10),
    annee date 
);


create SEQUENCE sq_etu increment 1 start with 1;
create table etudiant(
    id_etudiant VARCHAR(50) PRIMARY KEY DEFAULT 'ETU' || LPAD(nextval('sq_etu')::TEXT, 5, '0'),
    promo_id int REFERENCES promotion(id_prom),
    nom VARCHAR(100),
    prenom VARCHAR(50),
    date_naissance date 
);


create table semestre(
    id_semestre serial primary key ,
    semestre varchar(10)
);



create table matiere(
    id_matiere serial primary key , 
    id_semestre int REFERENCES semestre(id_semestre),
    code_matiere VARCHAR(10),
    nom_matiere VARCHAR(100),
    credit int 
);


create table semestre_matiere(
    id_sematie serial primary key,
    matier_id int REFERENCES matiere(id_matiere),
    semestre_id int REFERENCES semestre(id_semestre),
    goupe int
);

create table semestre_etud(
    id_semetu serial primary key ,
    id_sem int REFERENCES semestre(id_semestre),
    etudiant_id VARCHAR(30) REFERENCES etudiant(id_etudiant)
);


create table note(
    id_note serial primary key,
    id_etu VARCHAR(20) REFERENCES etudiant(id_etudiant),
    matiere_id int REFERENCES matiere(id_matiere),
    resultat numeric(8,2) 
  
    
);



create table configurations (
    id_config serial primary key ,
    code VARCHAR(20),
    config VARCHAR(40),
    valeur int 
);

create SEQUENCE sq_etu increment 1 start with 1;
create table import_etudiant(
    NumETU VARCHAR(50) PRIMARY KEY DEFAULT 'ETU' || LPAD(nextval('sq_etu')::TEXT, 5, '0'),
    Nom VARCHAR(150),
    Prenom  VARCHAR(100) ,
    Genres 	VARCHAR(50),
    DateNaissance date ,
    Promotion VARCHAR(20)
);

            INSERT(insert into etudiant(id_etudiant,promo_id,nom,prenom,date_naissance,genre)
            select
                im.NumETU ,p.id_prom , im.Nom ,im.Prenom,im.DateNaissance,im.Genres
            from import_etudiant im
                Join promotion p on p.promotion=im.Promotion,
            )



create table licence(
    id_licence serial primary key ,
    nom varchar(40)
);
insert into licence(nom)values('L1'),('L2'),('L3');

create table note_csv(
    id_notecsv serial primary key,
    numetu VARCHAR(50) ,
    nom VARCHAR(150),
    prenom  VARCHAR(100) ,
    genre 	VARCHAR(50),
    datenaissance date ,
    promotion VARCHAR(20),
     codematiere VARCHAR(20),
    semestre VARCHAR(10),
    note NUMERIC(8,2)
);

insert into etudiant(id_etudiant,promo_id,nom,prenom,date_naissance,genre)
            select
                nc.NumETU ,p.id_prom , nc.Nom ,nc.Prenom,nc.DateNaissance,nc.Genres
            from note_csv nc
                Join promotion p on p.promotion=nc.Promotion;


insert  into note(id_etu,matiere_id,resultat)
    select 
        etu.id_etudiant,mat.id_matiere,nc.note
    from note_csv nc
        join maiere mat on nc.CodeMatiere=mat.code_matiere
        join etudiant etu on etu.id_etudiant=nc.NumETU
;



INSERT INTO note (id_etu, matiere_id, resultat)
SELECT DISTINCT   
    et.id_etudiant,
    cv.codematiere,
    cv.note
FROM note_csv cv
JOIN etudiant et ON et.id_etudiant = cv.numetu
LEFT JOIN matiere m ON m.code_matiere = cv.codematiere  where id_etudiant='ETU001511';

