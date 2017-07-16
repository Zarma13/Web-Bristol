<!-- https://css-tricks.com/footable-a-jquery-plugin-for-responsive-data-tables/ -->

<h1>Student List</h1>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Last name</th>
            <th>First name</th>
            <th>Student number</th>
            <th>Date of birth</th>
            <th>Address</th>
            <th>Phone number</th>
            <th>Email</th>
        </tr>

        <?php
        foreach ($listStudents as $student) {
            echo "<tr>";
            echo "<td>" . $student->LastName . "</td>";
            echo "<td>" . $student->FirstName . "</td>";
            echo "<td>" . $student->IDUser . "</td>";
            echo "<td>" . $student->Birthday . "</td>";
            echo "<td>" . $student->Address . "</td>";
            echo "<td>" . $student->PhoneNumber . "</td>";
            echo "<td>" . $student->Email . "</td>";
            echo "</tr>";
        }
        ?>

    </table>
</div>