«<!DOCTYPE html>»
<html>  
<body>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 

<h1><%=buba%></h1>

<form method = "post" id = "sendData">
  <label for="sendData">Add number to the database : </label><br>
    <input type="text" id="fname" value="" ><br><br>
    <input type="submit" value="Submit" >
  </form> 

  <form method = "post" id = "editData" style="visibility: hidden">
    <label for="editData">Edit the selected number : </label><br>
    <input type="text" id="ename" value="" ><br><br>
    <input type="submit" value="Submit" >
  </form> 

  <table border="1" class="table table-striped table-bordered" id="sData">
    <thead>
        <tr>
            <th>Nr introdus</th>
            <th>Nr random</th>
            <th>Suma</th>
            <th>Id</th>
            <th>edit</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

  <script>
    var selectedId;
    var oldNum;
    $(document).ready(function(){
      load_data();
      $("#sendData").submit(function(e) {
        e.preventDefault();
        var inputNr = document.getElementById('fname').value;
        add_data(inputNr);
        load_data();
        //document.getElementById("sendData").style.display = "none";
    });
    $("#editData").submit(function(e) {
        e.preventDefault();
        var inputNr = document.getElementById('ename').value;
        edit_data(inputNr,selectedId,oldNum);
        load_data();
    });
    
    
    function add_data(number)
    {
      $.post('script.php', { action: 'add' , newData: number}, function(data) {
        console.log(data);
        load_data();
      });
      
    }
    function load_data()
    {
      $.post('script.php', { action: 'fetch' }, function(data) {
        var data = JSON.parse(data);
        var html = '';
        
                if(data.length > 0)
                {
                    for(var count = 0; count < data.length; count++)
                    {
                      var url = '<a href="http://localhost:3000/edit?inputNumber='+data[count].input+'&uid='+ data[count].id +'">edit</a>';  
                      html += `
                        <tr>
                            <td>`+data[count].input_number+`</td>
                            <td>`+data[count].random_number+`</td>
                            <td>`+data[count].number_result+`</td>
                            <td>`+data[count].id+`</td>
                            
                            <td><button type="button" id='`+data[count].id+`' onclick='showForm(`+data[count].id+`,`+data[count].input_number+`)' >edit</button></td>
                            
                        </tr>
                        
                        `;
                    }
                }

                $('#sData tbody').html(html);
      });
      
    }

    });
    function edit_data(number,tId,oldInput)
        {
          document.getElementById("editData").style.visibility = "hidden";
            $.post('script.php', { action: 'edit' , newData: number,id : tId,old : oldInput}, function(data) {
              
            console.log(data);
            load_data();
          });
          
        }
    function showForm(id,number){
      document.getElementById("editData").style.visibility = "visible";
      document.getElementById("ename").value = number;
      selectedId = id;
      oldNum = number;
      console.log(id, "   ", number);
    }

    
  </script>
  <p id = "p1" style="border-width:3px; border-style:solid; border-color:#FF0000; padding: 1em;">void</p>
</body>
</html>

