



<div class="row">
    <div class="col-md-11">
        <h1>Students Grades</h1>
    </div>
    <div class="col-md-1">
        <a class="btn btn-primary title-margin" href="?controller=examStaff&action=sendmail"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Send mail</a> 
    </div>
</div>


<row>
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-hover table-modules">
            <tr>
                <th>Module</th>
                <th>Component</th>
                <th>Student</th>
                <th>Grade</th>
                <th>Update</th>
            </tr>
                
            <?php
                foreach ($tab_allNotes as $module => $infoModule) {
                    foreach ($infoModule as $keyInfoStudent => $infoStudent) {
                        foreach ($infoStudent as $student => $info) {
                            foreach ($info as $component => $infoComponent) {
                                if ($component !== "mean") {
                                    echo "<tr>";
                                    echo "<td>" . $module . "</td>";
                                    echo "<td>" . $infoComponent["component"] . "</td>";
                                    echo "<td>" . $student . "</td>";
                                    echo "<td>" . $infoComponent["note"] . "</td>";
                                    echo '<td>
                                        <button type="button" class="btn btn-default">
                                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                                        </button>
                                    </td>';
                                    echo "</tr>";
                                }
                            }
                        }
                    }
                }
                foreach ($tab_notDone as $value) {
                    echo "<tr>";
                    echo "<td>" . $value->ModuleName . "</td>";
                    echo "<td>" . $value->ExamType . "</td>";
                    echo "<td>" . $value->FirstName . " " . $value->LastName . "</td>";
                    echo "<td>Not done</td>";
                    echo '<td>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </button>
                        </td>';
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</row>
