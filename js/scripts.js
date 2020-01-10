let categories = new Map([
    ['fresh_fish', 'Свежая рыба'],
    ['canned_food', 'Консервы'],
    ['semi_manufactures', 'Полуфабрикаты'],
    ['caviar', 'Икра'],
    ['frozen_fish', 'Замороженная рыба']
])

function label(forWhat, label){
    let newLabel = document.createElement('label')
    newLabel.htmlFor=forWhat
    newLabel.innerHTML=label
    document.getElementById('selector_div').insertBefore(newLabel, document.getElementById(forWhat))
}

function createChartDiv(){
    let area = document.createElement('div')
        area.id='chart_div'
        area.className='col-sm'
        document.getElementById('mainArea').appendChild(area)
}
function clearMainArea(){
    let mainArea = document.getElementById('mainArea')
    while(mainArea.firstChild){
        mainArea.removeChild(mainArea.firstChild)
    }
}
function createGrid(colsNum){
    clearMainArea();
    let row1 = document.createElement('div')
    row1.id='selector_div'
    row1.className='row'
    //row1.style.backgroundColor='violet'
    row1.style.height='75px'
    row1.style.padding='10px'
    let row2 = document.createElement('div')
    row2.id='row2'
    row2.className='row'
    //row2.style.backgroundColor='aqua'
    row2.style.height='500px'
    let col1 = document.createElement('div')
    col1.id='chart_div'
    col1.className='col-sm'
    //col1.style.backgroundColor='green'
    let col2 = document.createElement('div')
    col2.id='info_div'
    col2.className='col-sm'
    document.getElementById('mainArea').appendChild(row1)
    document.getElementById('mainArea').appendChild(row2)
    document.getElementById('row2').appendChild(col1)
    document.getElementById('row2').appendChild(col2)
}

function createDatePicker(id, value){
    let datepicker = document.createElement('input')
    datepicker.style.height='30px'
    datepicker.id=id
    datepicker.type='date'
    datepicker.value=value
    datepicker.min=getMinMaxDate().min_bound.substring(0,10)
    datepicker.max=getMinMaxDate().max_bound.substring(0,10)
    let place = document.getElementById('selector_div').appendChild(datepicker)
}
function processDataToChartTypeByCountry(dataToProceed){
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
function processDataToChartTypeByActionTime(dataToProceed){
    //console.log(dataToProceed);
    let tmp_data = Array();
    for(let i=0; i<dataToProceed.length; i++){
        let tmpAr = Array();
        tmpAr[0] = dataToProceed[i].action_time.substring(10,13);
        tmpAr[1] = parseInt(dataToProceed[i].calls);
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
function processDataToChartTypeByTimeOfDay(dataToProceed){
    //console.log(dataToProceed);
    let tmp_data = Array();
    for(let i=0; i<dataToProceed.length; i++){
        let tmpAr = Array();
        tmpAr[0] = dataToProceed[i].time_of_day;
        tmpAr[1] = parseInt(dataToProceed[i].calls);
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
    clearMainArea()
    createGrid()
    let chartData = JSON.parse(getMostFrequentCountry_List())
    chartData = processDataToChartTypeByCountry(chartData)
    let infoDiv = document.getElementById('info_div')
    infoData = chartData[1]
    chartData = chartData[0]
    //console.log(tshit)
    drawPieChart(chartData, 'Количество запросов из стран');
    infoDiv.innerHTML='Посетители из '+chartData[infoData][0]+' совершают '+chartData[infoData][1]+' действий на сайте'
}
function drawMostFrequentCountryByCategory(){
    let selectedValue = document.getElementById('categoryList').value
    let chartData = JSON.parse(getMostFrequentCountryByCategoryList(selectedValue))
    chartData = processDataToChartTypeByCountry(chartData)
    let infoDiv = document.getElementById('info_div')
    infoData = chartData[1]
    chartData = chartData[0]
    console.log(chartData)
    drawPieChart(chartData, 'Количество запросов из стран по категории "'+categories.get(selectedValue)+'"')
    infoDiv.innerHTML='Посетители из '+chartData[infoData][0]+' совершают '+chartData[infoData][1]+' действий на сайте в категории '+ categories.get(selectedValue)
}
function getMostFrequentCountryByCategory(){
    clearMainArea()
    createGrid()
    //let area = document.createElement('div');
    //document.getElementById('mainArea').appendChild(area);
    let categoryList = document.createElement('select')
    categoryList.id='categoryList'
    categoryList.style.height='25px'
    categoryList.style.marginTop='5px'
    categoryList.addEventListener('change', drawMostFrequentCountryByCategory, false)
    document.getElementById('selector_div').appendChild(categoryList);
    let temp = JSON.parse(getCategoriesList())
    for(let i=0; i<temp.length; i++){
        let categoryList_Option = document.createElement('option')
        categoryList_Option.value=temp[i].category
        categoryList_Option.innerHTML = categories.get(temp[i].category)
        document.getElementById('categoryList').appendChild(categoryList_Option);
    }
    drawMostFrequentCountryByCategory()
}

function drawLoadByHour(){
    console.log('qqq')
    let datepicker = document.getElementById('datepicker')
    let day = datepicker.value
    console.log(day)
    let chartData = JSON.parse(getLoadByHourList(day))
    chartData = processDataToChartTypeByActionTime(chartData)[0]
    drawLineChart(chartData, 'Количество запросов по часам', 1000)
    console.log(chartData)
}

function getLoadByHour(){
    clearMainArea()
    //createChartDiv()
    createGrid()
    createDatePicker('datepicker', '2018-08-01')
    let datepicker = document.getElementById('datepicker')
    let datepicker_label = document.createElement('label')
    datepicker_label.htmlFor='datepicker'
    datepicker_label.innerHTML='Выберите дату: '
    document.getElementById('selector_div').insertBefore(datepicker_label, datepicker)
    datepicker.addEventListener('change', drawLoadByHour)
    drawLoadByHour()
}
function drawFrequencyByTimeOfDay(){
    let selectedValue = document.getElementById('categoryList').value
    let chartData = JSON.parse(getFrequencyByTimeOfDayList(selectedValue))
    chartData = processDataToChartTypeByTimeOfDay(chartData)[0]
    drawColumnChart(chartData, 'Количество запросов по времени суток в категории "'+categories.get(selectedValue)+'"', 1000)
    console.log(chartData);
}

function getFrequencyByTimeOfDay(){
    clearMainArea()
    createGrid()
    let categoryList = document.createElement('select')
    categoryList.id='categoryList'
    categoryList.style.height='25px'
    categoryList.style.marginTop='5px'
    categoryList.addEventListener('change', drawFrequencyByTimeOfDay, false)
    document.getElementById('selector_div').appendChild(categoryList);
    let temp = JSON.parse(getCategoriesList())
    for(let i=0; i<temp.length; i++){
        let categoryList_Option = document.createElement('option')
        categoryList_Option.value=temp[i].category
        categoryList_Option.innerHTML = categories.get(temp[i].category)
        document.getElementById('categoryList').appendChild(categoryList_Option);
    }
    drawFrequencyByTimeOfDay()
}

function drawUnpaidCartsCount(){
    datepickerMin = document.getElementById('datepicker_min')
    datepickerMax = document.getElementById('datepicker_max')
    unpaidCartsCount = JSON.parse(getUnpaidCartsCount(datepickerMin.value, datepickerMax.value))[0]
    infoArea = document.getElementById('chart_div')
    infoArea.innerHTML='За заданный период имеется '+unpaidCartsCount.count+ ' неоплаченных корзин'
}

function getUnpaidCarts(){
    clearMainArea()
    createGrid()
    createDatePicker('datepicker_min', getMinMaxDate().min_bound.substring(0,10))
    createDatePicker('datepicker_max', getMinMaxDate().max_bound.substring(0,10))
    datepickerMin = document.getElementById('datepicker_min')
    datepickerMax = document.getElementById('datepicker_max')
    datepickerMin.addEventListener('change', drawUnpaidCartsCount)
    datepickerMax.addEventListener('change', drawUnpaidCartsCount)
    label(datepickerMin.id, 'Выберите период с: ')
    label(datepickerMax.id, 'до: ')
    drawUnpaidCartsCount()
}