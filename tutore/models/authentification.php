<?php
function pseudo($nom,$prenom){  //pour mettre le nom et prenom ensemble
    $no=substr($nom,0,4);
    $pno=substr($prenom,0,4);
    $identifiant=$no."".$pno;
    return $identifiant;
}

function mdp(){  //creer un mdp par hassard
    $mdp = '';
    for ($i = 0; $i < 8; $i++)
    {
    $mdp .= chr(mt_rand(97, 122));
    }
    return $mdp;
}