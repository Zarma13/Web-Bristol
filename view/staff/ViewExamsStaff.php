<h1>Exams List</h1>

<row>
    <div class="col-md-10 col-md-offset-1">
        <div class="table-responsive">
        <table class="table table-hover table-modules">
            <tr>
                <th>Module</th>
                <th>Type of exam</th>
                <th>Details</th>
                <th>Teacher</th>
                <th>Date of exam</th>
                <th>Actions</th>
            </tr>

            <?php
                foreach ($tab_examsDetails as $exam) {
                ?>
                    <tr>
                        <td>
                            <?php
                                echo $exam->ModuleName;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $exam->ExamType;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $exam->Details;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $exam->FirstName . " " . $exam->LastName;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $exam->DateExam;
                            ?>
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
        </div>
        <h2>Add an exam </h2>
        <div class="table-responsive">
        <form>
            <table class="table table-hover table-modules">
                <tr>
                    <th>Module</th>
                    <th>Type of exam</th>
                    <th>Details</th>
                    <th>Teacher</th>
                    <th>Date of exam</th>
                </tr>
                <tr>
                    <td>
                        <select name="module" size="1">
                            <?php 
                                foreach ($tab_modules as $module) {
                                    echo "<option>" . $module->Name;
                                }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="examType">
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
                    <td>
                        <input type="date" name="dateExam">
                        <input type="time" name="timeExam">
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</row>
