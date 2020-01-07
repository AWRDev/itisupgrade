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
            return_value=result;
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
function processDataToChartType(dataToProceed){
    //console.log(dataToProceed);
    let tmp_data = Array();
    for(let i=0; i<dataToProceed.length; i++){
        let tmpAr = Array();
        tmpAr[0] = dataToProceed[i].country;
        tmpAr[1] = parseInt(dataToProceed[i].num);
        dataToProceed[i] = tmpAr;
    }
    let id = 0;
    let max = 0;
    for(let i=0; i<dataToProceed.length; i++){
        if(parseInt(dataToProceed[i][1])>=max){
            max = parseInt(dataToProceed[i][1]);
            id = i;
        }
    }
    //proceededData=dataToProceed
    let proceededData = Array();
    proceededData[0]=dataToProceed;
    proceededData[1]=id
    return proceededData
}
function getMostFrequentCountry(){
    //Сюда добавить проверку на существование блока
    let area = document.createElement('div')
    area.id='chart_div'
    area.className='col-sm'
    document.getElementById('mainArea').appendChild(area)
    let json_coded_string = JSON.parse(getMostFrequentCountry_List())
    let tshit
    json_coded_string = processDataToChartType(json_coded_string)[0]
    //console.log(tshit)
    drawChart(json_coded_string);
}
function test(){
    let selectedValue = document.getElementById('categoryList').value
    let chartData = JSON.parse(getMostFrequentCountryByCategoryList(selectedValue))
    //console.log(document.getElementById('categoryList').value)
    chartData = processDataToChartType(chartData)[0]
    console.log(chartData)
    drawChart(chartData)
}
let temp
function getMostFrequentCountryByCategory(){
    //document.getElementById('mainArea').removeChild(document.getElementById('chart_div'))
    let area = document.createElement('div');
    document.getElementById('mainArea').appendChild(area);
    let categoryList = document.createElement('select')
    categoryList.id='categoryList'
    categoryList.style.height='50px'
    //categoryList.style.width='500px'
    categoryList.addEventListener('change', test, false)
    document.getElementById('mainArea').appendChild(categoryList);
    temp = JSON.parse(getCategoriesList())
    for(let i=0; i<temp.length; i++){
        let categoryList_Option = document.createElement('option')
        categoryList_Option.value=temp[i].category
        categoryList_Option.innerHTML = temp[i].category
        document.getElementById('categoryList').appendChild(categoryList_Option);
    }
}