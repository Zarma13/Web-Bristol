<?php

class ModelExam extends Model
{

    protected static $table = "Exam";

    public static function selectAllExamDetails () {
        try {
            $sql = "SELECT e.*, u.FirstName, u.LastName "
                    . "FROM " . static::$table . " e, Module m, User u "
                    . "WHERE m.Name = e.ModuleName "
                    . "AND m.IDTeacher = u.IDUser;";
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }

    public static function getResults ($idStudent) {


        try {
            $sql = "SELECT n.*, e.Weightage "
                    . "FROM Exam e, Note n "
                    . "WHERE n.ModuleName = e.ModuleName "
                    . "AND n.ExamType = e.ExamType "
                    . "AND n.IDStudent = :id;";
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute(array('id' => $idStudent));
            $notes = $req->fetchAll(PDO::FETCH_OBJ);
            $modules = array();
            $failedModules = array();

            /** Organize by modules * */
            foreach ($notes as $exam) {
                $modules[$exam->ModuleName]["notes"][] = array(
                    'exam' => $exam->ExamType,
                    'note' => $exam->Note,
                    'weightage' => $exam->Weightage
                );
                if (!isset($modules[$exam->ModuleName]["passed"]) || $modules[$exam->ModuleName]["passed"]) {
                    $modules[$exam->ModuleName]["passed"] = $exam->Note < 40 ? false : true;
                }
            }



            /** Calculate if module avg > 50 * */
            foreach ($modules as $modulename => $data) {

                if (!$data['passed']) {
                    $failedModules[] = array(
                        'name' => $modulename,
                        'reason' => 'examNoteUnder40'
                    );
                }


                $average = 0;
                foreach ($data["notes"] as $exam) {
                    $average += $exam['note'] * ($exam['weightage'] / 100);
                }

                if ($average < 50 && $data['passed']) {
                    $failedModules[] = array(
                        'name' => $modulename,
                        'reason' => 'avgUnder50'
                    );
                }
                $modules[$modulename]['average'] = $average;
 
                $letter;
                if ($average < 50 || !$data['passed']) {
                    $letter = 'Failed';
                }
                else if ($average < 60) {
                    $letter = "C";
                }
                else if ($average < 70) {
                    $letter = "B";
                }
                else if ($average < 80) {
                    $letter = "A";
                }
                else if ($average < 90) {
                    $letter = "A+";
                }
                else {
                    $letter = "A++";
                }
                $modules[$modulename]['averageLetter'] = $letter;

                
            }

            $studentResults = array();
            $studentResults['failed_modules'] = $failedModules;
            $studentResults['modules_notes'] = $modules;
           // var_dump($studentResults);
            return $studentResults;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error in database " . static::$table);
        }
    }

    public static function getResits ($idStudent) {
        $studentResults = self::getResults($idStudent);
        return $studentResults['failed_modules'];
    }

    public static function doesUserPayResits ($idStudent) {

        try {
            $sql = "SELECT paidResits FROM User WHERE IDUser = :id";
            $req = self::$pdo->prepare($sql);
            // execution de la requete
            $req->execute(array('id' => $idStudent));
            $res = $req->fetch(PDO::FETCH_OBJ);

            return (bool) $res->paidResits;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error in database " . static::$table);
        }
    }

}
