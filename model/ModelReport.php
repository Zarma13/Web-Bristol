<?php

class ModelReport extends Model {
    
    protected static $table = "ModuleParticipant";

    // TODO :
    // Récupérer élèves d'une module
    // Récupérer note de cet élève poru le module donné
    
    public static function selectModuleStudentsList($module) {
        try {
            $sql = "SELECT u.FirstName, u.LastName, u.IDUser "
                 . "FROM User u, " . static::$table . " mp "
                 . "WHERE u.IDUser = mp.IDStudent "
                 . "AND mp.ModuleName = '" . $module . "';";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    public static function selectNoteModuleStudent($module) {
        try {
            $sql = "SELECT n.*, e.Weightage, u.FirstName, u.LastName "
                 . "FROM Exam e, Note n, User u "
                 . "WHERE n.ModuleName = e.ModuleName "
                 . "AND n.ModuleName = '" . $module . "' "
                 . "AND n.ExamType = e.ExamType "
                 . "AND u.IDUser = n.IDStudent "
                 . "ORDER BY n.IDStudent;";
            $req = self::$pdo->query($sql);
            $tab_notes = $req->fetchAll(PDO::FETCH_OBJ);
            
            $tab = array();
            
            foreach ($tab_notes as $value) {
                $tab[$value->FirstName . " " . $value->LastName][] = array(
                    'component' => $value->ExamType,
                    'note' => $value->Note,
                    'weightage' => $value->Weightage
                );
            }     
            
            foreach ($tab as $student => $note) {
                $mean = 0;
                $failed = false;
                
                foreach ($note as $value) {        
                    $mean = $mean + $value['note'] * ($value['weightage']/100);
                    if ((int)$value['note'] < 40){ $failed = true;}
                }
                
                $tab[$student]['mean'] = $mean;
                
                $letter;
                if ($mean < 50 || $failed) {
                    $letter = 'Failed';
                }
                else if ($mean < 60) {
                    $letter = "C";
                }
                else if ($mean < 70) {
                    $letter = "B";
                }
                else if ($mean < 80) {
                    $letter = "A";
                }
                else if ($mean < 90) {
                    $letter = "A+";
                }
                else {
                    $letter = "A++";
                }
                $tab[$student]["letter"] = $letter;
                
             }

            return $tab;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    public static function selectAllModulesStudent($IDStudent) {
        try {
            $sql = "SELECT DISTINCT n.* "
                 . "FROM ModuleParticipant mp, Note n "
                 . "WHERE mp.IDStudent = n.IDStudent "
                 . "AND mp.IDStudent = " . $IDStudent . ";";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    public static function getFailResult() {
        try {
            $tab_modules = ModelModule::selectAll();
            $tab_moduleInfo = array();
            $result = array();
            
            foreach ($tab_modules as $module) {
                $studentList = self::selectModuleStudentsList($module->Name);

                $nbStudentModule = count($studentList);
                
                $nbFailStudentModule = 0;
                $nbFailResitStudentModule = 0;
                
                foreach ($studentList as $student) {
                    $result = ModelExam::getResults($student->IDUser);
                    foreach ($result as $key => $value) {
                        if ($key === "failed_modules" && $value != NULL) {
                            foreach ($value as $v) {
                                if ($v['name'] === $module->Name) {
                                    $nbFailStudentModule++;
                                }
                            }
                        }
                    }
                    
                    $tab_moduleInfo[$module->Name][$student->FirstName . " " . $student->LastName][] = $result;
                }
                
                $sql = "SELECT rs.* "
                     . "FROM ResitNote rs "
                     . "WHERE rs.ModuleName = '" . $module->Name . "';";
                $req = self::$pdo->query($sql);
                $resitReq = $req->fetchAll(PDO::FETCH_OBJ);

                foreach ($resitReq as $key => $value) {
                    if ($value->Note < 40) {
                       $nbFailResitStudentModule++; 
                    }
                }
                    
                $tab_moduleInfo[$module->Name]["info"][] = array (
                    'nbStudent' => $nbStudentModule,
                    'nbFail' => $nbFailStudentModule,
                    'nbFailResit' => $nbFailResitStudentModule
                );
            }
            
            return $tab_moduleInfo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    public static function getPassFailList($module) {
        $studentList = self::selectModuleStudentsList($module);

        $listPass = array();
        $listFail = array();
       
        foreach ($studentList as $student) {
            $result = ModelExam::getResults($student->IDUser);
            
            foreach ($result as $key => $value) {
                if ($key === "modules_notes" && $value != NULL) {
                    foreach ($value as $k => $v) {
                        if ($k === $module) {
                            if ($v['passed']) {
                                array_push($listPass, $student->FirstName . " " . $student->LastName);
                            }
                            else
                            {
                                array_push($listFail, $student->FirstName . " " . $student->LastName);
                            }
                        }
                    }
                }
            }            
        }
        
        $result = array(
            'listPass' => $listPass,
            'listFail' => $listFail
        );
        
        return $result;
    }
    
    public static function selectNoteAllModuleAllStudent() {
        $result = array();
        
        $tab_modules = ModelModule::selectAll();
        
        foreach ($tab_modules as $module) {
            $result[$module->Name][] = self::selectNoteModuleStudent($module->Name);
        }
        
        return $result;
    }
    
    public static function selectAllNotDoneExam() {
        try {
            $sql = "SELECT distinct mp.ModuleName, n.ExamType, u.FirstName, u.LastName "
                 . "FROM ModuleParticipant mp, User u, Note n "
                 . "WHERE u.IDUser = mp.IDStudent "
                 . "AND (mp.ModuleName, mp.IDStudent, n.ExamType) "
                 . "NOT IN ( "
                 . "SELECT n.ModuleName, n.IDStudent, n.ExamType "
                 . "FROM ModuleParticipant mp, Note n "
                 . "WHERE mp.ModuleName = n.ModuleName "
                 . "AND n.IDStudent = mp.IDStudent "
                 . ");";
            $req = self::$pdo->query($sql);
            return $req->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die("Error while parsing database " . static::$table);
        }
    }
    
    

}
