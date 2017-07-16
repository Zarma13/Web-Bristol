<?php


class ModelCommande extends Model {

    protected static $table = "Commande";
    protected static $primary_index = "idCommande";
    
    public static function insertAndGetId($data) {
        try {
            $table = static::$table;
            $indices = "";
            $values = "";
            foreach ($data as $key => $value){
                $indices .= "$key, ";
                $values .= ":$key, ";
            }
            $indices = '(' . rtrim($indices, ', ') . ')';
            $values = '(' . rtrim($values, ', ') . ')';
            $sql = "INSERT INTO $table $indices VALUES $values";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);
            return self::$pdo->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("<br /> Erreur lors de l'insertion dans la BDD " . static::$table);
        }
    }
    
    public static function calculePrixCommande($parcelles, $tools)
    {
        $prix=0;
        foreach($parcelles as $parcelle)
        {
            $cam= $parcelle->camera;
            $nbSonde= $parcelle->nbSonde;
            $sysM= $parcelle->sysMaturation;
            
            $prix=$prix+25;
            if($cam)
            {
                $prix=$prix+3;
            }
            for($j=0; $j<$nbSonde; $j++)
            {
                $prix=$prix+2;
            }
            if($sysM)
            {
                $prix=$prix+5;
            }
            if($tools==1)
            {
                $prix=$prix+0;
            }
            if($tools==2)
            {
                $prix=$prix+5;
            }
            if($tools==3)
            {
                $prix=$prix+10;
            }
            if($tools==4)
            {
                $prix=$prix+15;
            }   
        }
        return $prix;
    }

    public static function getToolsCommande($data)
    {
        try 
        {
            $commande_list = ModelUtilisateur::getAllCommande($data);
            foreach ($commande_list as $cl)
            {
                $idC= $cl->idCommande;
                $data=array('idCommande'=>$idC);
            }
                
                $sql = "SELECT idPack FROM Commande c WHERE idCommande= :idCommande";                       
                // Preparation de la requete
                $req = self::$pdo->prepare($sql);
                // execution de la requete
                $req->execute($data);
                return $req->fetchAll(PDO::FETCH_OBJ);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("<br /> Erreur dans la BDD " . static::$table);
        }
    }
    
    public static function setPrixCommande($data)
    {
        try {
            
            $sql = "UPDATE Commande SET prix = :prix WHERE idCommande= :idC";
            // Preparation de la requete
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            return $req->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Erreur dans la BDD " . static::$table);
        }
    }
    
    
}
