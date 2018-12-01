function openPage(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        tabcontent[i].className.replace(" contentactive", "");
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace("active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
$(document).ready( function() {
    $("#datePicker").hide();
  //  $('#datePicker').val(new Date().toDateInputValue());
   $( "#start_time" ).change(function(){
        //$( "#end_time" ).value = '18:00:00';
        if (   $( "#start_time" ).val() > $( "#end_time" ).val()  ) {
            $( "#end_time" ).val(this.value);;
        }
        $( "#end_time" ).attr({'min': this.value });
    });
    
    $("#other-chckbx").change( function() {
        if(this.checked) {
      // checkbox is checked
            $('.chckbx-btn-wd').prop( "checked", false );
            $("#datePicker").show();
        }else{
            $("#datePicker").hide();
        }
    });
    $(".chckbx-btn-wd").change( function() {
        if(this.checked) {
      // checkbox is checked
            $('#other-chckbx').prop( "checked", false );
            $("#datePicker").hide();
        }else{
            $("#datePicker").show();
        }
    });
});