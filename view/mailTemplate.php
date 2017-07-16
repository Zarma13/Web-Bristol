<?php

$messageTpm = <<<END
<style>
    .content {
        margin:50px auto;

        width: 100%; /* largeur obligatoire pour être centré */
        max-width: 500px;
    }


    #logoUwe{
        width: 150px;  
    }



    table
    {
        border-collapse: collapse; /* Les bordures du tableau seront collées (plus joli) */
        width: 90%;
        margin: auto;
        text-align: center;
    }

    td
    {
        border: 1px solid black;
    }

    .moduleName{
        font-weight: bold;


    }

    .green{
        background-color: #dff0d8;
    }

    .red{
        background-color: #f2dede;

    }

    .blue{

        background-color: #d9edf7
    }

    .yellow{
        background-color: #fcf8e3;

    }

    #footer{
        padding : 20px 5px;
        background-color: #282330;
        margin-top: 50px;
        color: lightgrey;


    }
</style>        
<div class="content" align="justify">
    <img id="logoUwe" alt="UWE - Bristol" src="http://style.uwe.ac.uk/branding/couplets/engine/images/logo.png">
    <br>
    <div >

        <p>Dear $name</p>

        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fermentum sapien non leo consequat tristique. Fusce iaculis eu mi sit amet maximus. Proin viverra metus quis velit vehicula, id accumsan est vestibulum. Nulla tempus, est eu pretium pharetra, ipsum nibh aliquam urna, in venenatis risus libero et arcu. Donec eget enim et nibh scelerisque gravida in vel tellus. Cras tempus ultricies diam, eu fringilla erat vestibulum sed. In nunc neque, maximus vel fringilla sed, maximus eu nisi. Fusce ut enim mauris. In elit lacus, tempus et ligula vel, convallis faucibus tortor. Ut nec molestie mi. Mauris rutrum volutpat nisl viverra tempor. Fusce in dolor tristique, mattis justo nec, venenatis ante. Vivamus vel diam a felis semper suscipit. </p>

        <table>
              
END;
             
            foreach ($results as $module => $moduleData) {
            
           $messageTpm .= "<tr class='moduleName'>
                <td>$module</td>
            <td>" .$moduleData['averageLetter'] . '</td>
            </tr>';
            
            foreach($moduleData['notes'] as $exam){

                 $messageTpm .= '<tr>
                    <td>' . $exam["exam"] .'</td>
                    <td>' . $exam["note"] . '/100</td>
                </tr>';
              } }
              
$messageTpm .= <<<END
   </table>
        <p>Quisque placerat urna vitae tristique aliquam. Maecenas eu tristique leo. Praesent dolor metus, interdum vel tincidunt eget, varius id mauris. Nullam a erat quis orci dapibus laoreet sed a justo. Aliquam congue suscipit magna eu rutrum. Maecenas interdum nibh purus, at porta lectus posuere id. Integer dignissim ex mi, sit amet sagittis quam viverra et. Quisque sed augue ut sapien porta lacinia sit amet sed metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lectus urna, pretium fermentum consectetur a, gravida et nisi. Maecenas aliquet erat non magna ornare, sit amet ultricies justo posuere. Donec eget ligula dolor. Pellentesque congue ultricies arcu sed iaculis. Donec volutpat purus sit amet orci scelerisque fermentum.</p>

        <p>Best regards.</p>
    </div>
    <div id="footer">
        <p>2016 —University of the West of Bristol</p> 

    </div>
</div>
END;
