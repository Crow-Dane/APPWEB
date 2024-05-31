Une application web de GESTION D'ETUDIANT pour l'IUFP

cahier de charge

#LIEN GITHUB du projet

https://github.com/Crow-Dane/APPWEB/tree/master

#iNSTALLER le logiciel d'enregistrement de l'ecran pour pouvoir visionner la video
https://www.freescreenrecording.com/

Email: hanneamadou22       //Pour un compte administrateur
Password: Hanne22

Email: user1@example.com    //Pour un compte utilisateur
Password: userpassword

//Quelques commandes SYMFONY CLI ou  PHP

 php bin/console doctrine:database:create // CREER UNE BASE DE DONNEE
 
 symfony console make:migration   // INITIALISE UNE MIGRATION

 symfony console doctrine:migrations:migrate // FAIRE UNE MIGRATION

 php bin/console cache:pool:clear --all    // VIDER LE CACHE
                                                       --dev  // VIDER LE CACHE EN DEVELOPPEMENT
                                                       --prod // VIDER LE CACHE EN PRODUCTION



GROUPE1
CHERIF SOULEMANE HAÏDARA
AMADOU HANNE 
HAMIDOU SACKO
NIAGA SIDIBE
SINE ZERBO


GESTION D'ETUDIANT


1- Authentification d'un utilisateur accédant à l'application

2- Authentification d'un administrateur accédant à l'application

3- Gestion des utilisateurs (ajout, suppression, mise à jour)

4- Gestion des administrateurs (ajout ou suppression ou mise à jour d'un utilisateur)


1- Affichage des informations d'un ancien étudiant (Prénom, Nom, Numéro de
Téléphone, Filière, Diplôme, Année de sortie (Promotion), Poste occupé, Type de
Contrat, Adresse du Lieu de Travail, .....)

2- Ajout des informations d'un ancien étudiant (Prénom, Nom, Numéro de Téléphone, Filière, Diplôme, Année de sortie (Promotion), Poste occupé, Type de Contrat, Adresse du Lieu de Travail,.....). L'utilisateur de cette fonctionnalité est un administrateur de l'IUFP.

3- Mise à jour des informations d'un ancien étudiant (Prénom, Nom, Numéro de Téléphone, Filière, Diplôme, Année de sortie (Promotion), Poste occupé, Type de Contrat, Adresse du Lieu de Travail, .....). L'utilisateur de cette fonctionnalité est un administrateur de l'IUFP.



1- Affichage du nombre total d' étudiants n'ayant pas d'emplois (au chômage) toutes filières confondues

2- Affichage du nombre total d' étudiants ayant trouvé un emploi toutes filières confondues

3- Affichage du nombre total d'étudiants ayant eu le DUT

4- Affichage du nombre total d'étudiants ayant eu la Licence 

5- Affichage du nombre total d'étudiants ayant eu le Master

6- Affichage du nombre total d'étudiants entreprises

7- Affichage du nombre total d'étudiants autoentrépréneur 

8- Affichage du nombre total d'étudiants fonctionnaires

9- Affichage des statistiques nombre d'étudiants total



20- Affichage des statistiques (nombre d'étudiants total, pourcentages des étudiants au chômage, 
pourcentage des étudiants ayant trouvé un emploi,
pourcentage des étudiants en auto-entrepreneuriat, 
pourcentage des étudiants entrepreneur, 
pourcentage des étudiants fonctionnaire,



1- Affichage des statistiques des étudiants ayant trouvé des emplois par filière (EMPLOYE PAR FILIERE )

2- Affichage des statistiques des étudiants n'ayant pas d'emplois (au chômage) par filière ( CHOMAGE PAR FILIERE )



1- Affichage du nombre total d' étudiants ayant trouvé un emploi par diplôme.(EMPLOYE PAR DIPLOME)



1- Affichage de la liste des anciens étudiants toutes filières et promotions confondues ( FILIRE )

2- Affichage de la liste des anciens étudiants par filière (FILIRE)

3- Affichage de la liste des anciens étudiants par filière et par diplôme obtenu (DUT ou Licence) (RECHERCHE ET TRIE)


