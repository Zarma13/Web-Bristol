var app = {
    init: function () {

        if ($("table.table-grades").length) {
            app.initGrades();
        }
        else if ($(".reportStaffTabs").length) {
            app.initTabsReports();
        }
        
        if (!$(".with-sidebar").length){
            // remove the burger icon from the homepage
            $(".glyphicon-menu-hamburger").hide();
        }
                   
                   
        $(".glyphicon-menu-hamburger").click(function(){
            $('.sidebar').toggleClass('open');
        });
        
        
        
    },
    initGrades: function () {

        $('table.table-grades tr.module td:nth-child(2)').each(function () {
            var grade = $(this).text();
            var bootstrap_class = "";
            switch (grade) {

                case "A":
                case "A+":
                case "A++":
                    bootstrap_class = "bg-success";
                    break;
                case "B":
                    bootstrap_class = "bg-info";
                    break;  
                case "C":
                    bootstrap_class = "bg-warning";
                    break;
                default:
                    bootstrap_class = "bg-danger";
                    break;
            }
            $(this).parent("tr.module").addClass(bootstrap_class);
        });
        
        
    },
    initTabsReports: function() {
        
       if (typeof tab != 'undefined'){
            $("ul.nav-tabs a[href='#" + tab + "']").tab('show');
        }

        $('#complete table tr td:last-child').each(function () {
            var grade = $(this).text();
            var bootstrap_class = "";
            switch (grade) {

                case "A":
                case "A+":
                case "A++": 
                    bootstrap_class = "bg-success";
                    break;
                case "B":
                    bootstrap_class = "bg-info";
                    break;
                case "C":
                    bootstrap_class = "bg-warning";
                    break;
                default:
                    bootstrap_class = "bg-danger";
                    break;
            }
            $(this).addClass(bootstrap_class);
        });
        
        
        
        /** Chart **/
        
        var chart_student = document.getElementById("chart-student");
        var notes = app.countResultsLetters($('#complete table tr td:last-child'));
        console.log(notes);
        var chartst = new Chart(chart_student, {
            type: 'bar',
            data: {
                labels: ["A++", "A+", "A", "B", "C", "D", "Failed"],
                datasets: [
                    {
                        label : 'Grades',
                        backgroundColor: [
                            
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255,99,132,1)'

                        ],
                        borderWidth: 1,
                        data: notes,
                    }
                ]
            }
        });

        
        
        

        if (typeof student != 'undefined') {
           $('.tab-content .active select option[value = ' + student+ ']').attr("selected", "")
       }else if (typeof moduleComplete != 'undefined'){
           $('.tab-content .active select option[value = "' + moduleComplete + '"]').attr("selected", "")
       }else if (typeof module != 'undefined'){
           $('.tab-content .active select option[value = "' + module + '"]').attr("selected", "")
       }

       
       
        $('.nav-tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
     
        $("select").change(function(){
            $(this).parent("form").submit();
        });
        
        
        
        
        
        
        
        
        
    },
    
    countResultsLetters: function(studentNotesTD){

        var notes = [];
        $(studentNotesTD).each(function(){
            notes.push($(this).text());
        });

        var  count = {'A++' : 0, 'A+' : 0, 'A' : 0, 'B' :0, 'C' :0, 'D' :0 , 'Failed' : 0}; 
        notes.forEach(function(i) { count[i] = (count[i]||0)+1;  });
        console.log(count);
        
        return $.map(count, function (value, index) {
            return [value];
        });
        
    }

};


app.init();