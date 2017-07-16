<h1>Modules List</h1>

<row>
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-hover table-modules">
            <tr>
                <th>Module</th>
                <th>Details</th>
                <th>Teacher</th>
                <th>Students number</th>
                <th>Date of exams</th>
                <th>Actions</th>
            </tr>

            <?php
                foreach ($tab_modulesDetails as $module) {
                ?>
                    <tr>
                        <td>
                            <?php
                                echo $module->Name;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $module->Details;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $module->FirstName . " " . $module->LastName;
                            ?>
                        </td>
                        <td>
                            <?php
                                $nb = 0;
                                
                                foreach ($tab_modulesNbParticipants as $value) {
                                    if ($value->Name == $module->Name) {
                                        $nb = $value->nb;
                                    }
                                }
                                
                                echo $nb;
                            ?>
                        </td> 
                        <td>
                            <ul>
                            <?php
                                foreach ($tab_modulesExamDates as $value) {
                                    if ($value->Name == $module->Name) {
                                        echo "<li>" . $value->DateExam . "</li>";
                                    }
                                }
                            ?>
                            </ul>
                        </td>  
                        <td>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>
                <?php
                }
           ?>
        </table>
        
        <h2>Add a module</h2>
        <form>
            <table class="table table-hover table-modules">
                <tr>
                    <th>Module</th>
                    <th>Details</th>
                    <th>Teacher</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="module">
                    </td>
                    <td>
                        <input type="text" name="details">
                    </td>
                    <td>
                        <select name="teacher" size="1">
                            <?php 
                                foreach ($tab_teachers as $teacher) {
                                    echo "<option>" . $teacher->FirstName . " " . $teacher->LastName;
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</row>
