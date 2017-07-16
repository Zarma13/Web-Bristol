<h1>Reports</h1>


<?php if (globalGet('tab')) { ?>
<script> var tab = "<?php echo globalGet('tab');?>";

<?php if (globalGet('student')) {
    echo "var student = '" . globalGet('student') . "';";
}else if (globalGet('moduleComplete')) {
    echo "var moduleComplete = '" . globalGet('moduleComplete') . "';";
}else if (globalGet('module')) {
    echo "var module = '" . globalGet('module') . "';";
}
?>


</script>
<?php } ?>



<row>
    <div class="col-md-10 col-md-offset-1 reportStaffTabs">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#complete" aria-controls="complete" role="tab" data-toggle="tab">Complete</a></li>
            <li role="presentation"><a href="#students" aria-controls="students" role="tab" data-toggle="tab">Students</a></li>
            <li role="presentation"><a href="#rate" aria-controls="rate" role="tab" data-toggle="tab">Module rate</a></li>
            <li role="presentation"><a href="#failList" aria-controls="failList" role="tab" data-toggle="tab">Fail list</a></li>
            <li role="presentation"><a href="#modulesDetails" aria-controls="modulesDetails" role="tab" data-toggle="tab">Modules details</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="complete">
                <form action="." method="GET">
                    
                    <input type="hidden" name ="controller" value="examStaff"/>
                    <input type="hidden" name ="action" value="viewReports"/>
                    <input type="hidden" name ="tab" value="complete"/>
                    <select name="moduleComplete" size="1" class="reportSelect">
                        <?php 
                            foreach ($tab_modules as $module) {
                                echo "<option value='" . $module->Name . "'>" . $module->Name;
                            }
                        ?>
                    </select>
                </form><div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tr>
                        <th>Student</th>
                        <?php
                            $components = array();
        
                            foreach ($tab_notes as $student) {         
                                foreach ($student as $key => $value) {
                                    if ($key !== "mean" && $key !== "letter")
                                    {
                                        if (!in_array($value['component'], $components)) {
                                            array_push($components, $value['component']);
                                            echo "<th>" . $value['component'] . "</th>";
                                        }
                                    }
                                }
                            }
                        ?>
                        <th>Mean</th>
                    </tr>
                    <?php
                        foreach ($tab_notes as $student => $arrayNote) {
                            echo "<tr>";
                            echo "<td>" . $student . "</td>";

                            foreach ($arrayNote as $key => $value) {

                                if ($key !== "mean" && $key !== "letter")
                                {
                                    echo "<td>" . $value["note"] . "</td>";
                                }
                                else
                                {
                                    echo "<td>" . $value . "</td>";
                                }
                            }

                            echo "</tr>";
                        }
                    ?>
                </table>
                </div>
                <canvas id="chart-student" width="300" height="200"></canvas>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="students">
                <form action="." method="GET">

                    <input type="hidden" name ="controller" value="examStaff"/>
                    <input type="hidden" name ="action" value="viewReports"/>
                    <input type="hidden" name ="tab" value="students"/>
                    <select name="student" size="1" class="reportSelect">
                        <?php
                        foreach ($tab_students as $student) {
                            echo "<option value='" . $student->IDUser . "'>" . $student->LastName . " " . $student->FirstName;
                        }
                        ?>
                    </select>
                </form>
                <div class="table-responsive"><table class="table table-hover table-bordered">
                    <tr>
                        <th>Module</th>
                        <?php
                            $components = array();
                            $modules = array();
        
                            foreach ($tab_notesStudent as $value) {
                                if (!in_array($value->ExamType, $components)) {
                                    array_push($components, $value->ExamType);
                                    echo "<th>" . $value->ExamType . "</th>";
                                }
                                if (!in_array($value->ModuleName, $modules)) {
                                    array_push($modules, $value->ModuleName);
                                }
                            }
                        ?>
                    </tr>
                    <?php
                        foreach ($modules as $module) {
                            echo "<tr>";
                            echo "<td>" . $module . "</td>";
                            foreach ($tab_notesStudent as $value) {
                                if ($value->ModuleName == $module)
                                {
                                    echo "<td>" . $value->Note . "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    ?>
                </table></div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="rate">
                <div class="table-responsive"><table class="table table-hover table-bordered">
                    <tr>
                        <th rowspan="2">Module</th>
                        <th colspan="2">Basic Exam</th>
                        <th colspan="2">Resit</th>
                    </tr>
                    <tr>
                        <td>Pass</td>
                        <td>Fail</td>
                        <td>Pass</td>
                        <td>Fail</td>
                    </tr>
                    <?php
                        foreach ($student_fail as $module => $infoModule) {
                            echo "<tr>";
                            echo "<td>" . $module . "</td>";
                            if ($infoModule["info"][0]["nbStudent"] == 0)
                            {
                                echo "<td>-</td>";
                                echo "<td>-</td>";
                                echo "<td>-</td>";
                                echo "<td>-</td>";
                            }
                            else
                            {
                                echo "<td>" . number_format(100 - (($infoModule["info"][0]["nbFail"] / $infoModule["info"][0]["nbStudent"])*100), 2)  . "%</td>";
                                echo "<td>" . number_format(($infoModule["info"][0]["nbFail"] / $infoModule["info"][0]["nbStudent"])*100, 2)  . "%</td>";
                                if ($infoModule["info"][0]["nbFail"] == 0)
                                {
                                    echo "<td>-</td>";
                                    echo "<td>-</td>";
                                }
                                else
                                {
                                    echo "<td>" . number_format(100 - (($infoModule["info"][0]["nbFailResit"] / $infoModule["info"][0]["nbFail"])*100), 2)  . "%</td>";
                                    echo "<td>" . number_format(($infoModule["info"][0]["nbFailResit"] / $infoModule["info"][0]["nbFail"])*100, 2)  . "%</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    ?>
                    
                </table></div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="failList">
                <div class="table-responsive"><table class="table table-hover table-bordered">
                    <tr>
                        <th>Student</th>
                        <th>Module(s)</th>
                    </tr>
                    <?php
                        foreach ($student_failedModules as $student => $info) {
                            if (count($info[0]) > 0) {
                                echo "<tr>";
                                echo "<td>" . $student . "</td>";
                                echo "<td>";
                                echo "<ul>";
                                foreach ($info as $moduleFailed) {
                                    foreach ($moduleFailed as $moduleFailedInfo) {
                                        echo "<li>" . $moduleFailedInfo["name"] . "</li>";
                                    }
                                }
                                echo "<ul>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </table></div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="modulesDetails">
                <form action="." method="GET">

                    <input type="hidden" name ="controller" value="examStaff"/>
                    <input type="hidden" name ="action" value="viewReports"/>
                    <input type="hidden" name ="tab" value="modulesDetails"/>
                    <select name="module" size="1" class="reportSelect">
                        <?php
                        foreach ($tab_modules as $module) {
                            echo "<option value='$module->Name'>" . $module->Name;
                        }
                        ?>
                    </select>
                </form>
                
                <div class="table-responsive"><table class="table table-hover table-bordered">
                    <tr>
                        <th>Pass</th>
                    </tr>
                    <?php
                        foreach ($tab_passFailList as $list => $students) {
                            if ($list === "listPass") {
                                foreach ($students as $student) {
                                    echo "<tr>";
                                    echo "<td>" . $student . "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    ?>
                </table></div>
                <div class="table-responsive"><table class="table table-hover table-bordered">
                    <tr>
                        <th>Fail</th>
                    </tr>
                    <?php
                        foreach ($tab_passFailList as $list => $students) {
                            if ($list === "listFail") {
                                foreach ($students as $student) {
                                    echo "<tr>";
                                    echo "<td>" . $student . "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    ?>
                </table></div>
            </div>
        </div>
    </div>
</row>