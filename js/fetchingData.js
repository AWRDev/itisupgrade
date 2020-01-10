function getMinMaxDate(){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'getMinMaxDate': 1},
        success:function(result){
            return_value=result;
        }
    })
    return_value=JSON.parse(return_value)[0]
    console.log(return_value)
    return return_value;
}
function getMostFrequentCountry_List(){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'getMostFrequentCountry': 1},
        success:function(result){
            return_value=result;
        }
    })
    return return_value;
}
function getCategoriesList(){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'getCategoriesList': 1},
        success:function(result){
            return_value=result
        }
    })
    return return_value;
}
function getMostFrequentCountryByCategoryList(category){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'getMostFrequentCountryByCategory': 1, 'category': category},
        success:function(result){
            return_value=result;
        }
    })
    //console.log(return_value)
    return return_value;
}
function getLoadByHourList(date){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'getLoadByHour': 1, 'date': date},
        success:function(result){
            return_value=result;
        }
    })
    console.log(return_value)
    return return_value;
}

function getFrequencyByTimeOfDayList(category){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'getFrequencyByTimeOfDay': 1, 'category': category},
        success:function(result){
            return_value=result;
        }
    })
    console.log(return_value)
    return return_value;
}

function getUnpaidCartsCount(date_from, date_to){
    let return_value;
    $.ajax({
        async: false,
        url:"fetchingData.php",
        type: "post",
        //datatype: "json",
        data: {'getUnpaidCartsCount': 1, 'date_from': date_from, 'date_to': date_to},
        success:function(result){
            return_value=result;
        }
    })
    console.log(return_value)
    return return_value;
}