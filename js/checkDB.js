function checkDB(){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'checkDB': 1},
        success:function(result){
            return_value=result;
        }
    })
    console.log(return_value)
    if(return_value=='No database found'){
        window.location.href='configDB.php'
    }
    return return_value;
}