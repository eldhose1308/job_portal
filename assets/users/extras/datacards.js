
/*
    1 - Loop Through Array & Access each value
  2 - Create Table Rows & append to table
*/

var tableData;
var state = {}
var datacard = "#na_datacard";

var trimStart;
var trimEnd;
//buildCard()

function getData(tableData_param, state_param = { 'querySet': tableData, 'page': 1, 'rows': 2, 'window': 5 }, datacard_param = "#na_datacard") {
    datacard = datacard_param;
    state_param.querySet = tableData_param;

    state_param.page = 1;
    state_param.window = 2;
    state = state_param;

    // console.log(state_param);
    tableData = tableData_param;
    createCard();
    buildCard();

    let page = parameterList.has('page') ? parameterList.get("page") : 1;
    $('.pagination-button[aria-page="' + page + '"]').trigger('click');

}

function pagination(querySet, page, rows) {

    trimStart = (page - 1) * rows
    trimEnd = trimStart + rows

    // console.log(page + " | " +trimStart + " - " + trimEnd);

    var trimmedData = querySet.slice(trimStart, trimEnd)

    var pages = Math.ceil(querySet.length / rows);
    // console.log(querySet);
    // console.log(querySet.length + " " + rows);
    return {
        'querySet': trimmedData,
        'pages': pages,
    }
}

$(document).on('change', '#na_datacard_length', function (e) {
    e.preventDefault();
    let value = $(this).val();
    alterCardLength(value);
});

$(document).on('keyup', '#search_datacard', function (e) {
    e.preventDefault();
    let value = $(this).val();
    searchCard(value);
});


function alterCardLength(value) {
    state.rows = Number(value);
    buildCard();
}


function searchCard(value) {
    var allData = tableData;
    var filteredData = [];
    var arr_length = 0;

    for (var i = 0; i < allData.length; i++) {
        arr_length = allData[i].length - 1;
        for (var j = 1; j < arr_length; j++) {

            value = value.toLowerCase();
            var elem = allData[i][j].toLowerCase();

            if (elem.includes(value)) {
                filteredData.push(allData[i]);
                break;
            }

        }
    }

    Fliteredstate = {
        'querySet': filteredData,
        'page': state.page,
        'rows': state.rows,
        'window': state.window
    }

    buildCard(Fliteredstate);
}


function pageButtons(pages, Fliteredstate) {

    let total_count = (Fliteredstate.querySet.length == trimEnd) ? trimEnd : Fliteredstate.querySet.length;
    let last_index = (Fliteredstate.querySet.length > trimEnd) ? trimEnd : total_count;


    var bottom_nav = `<div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="na_datatable_info" role="status" aria-live="polite">
                            Showing ${trimStart + 1} to ${last_index} of ${total_count} entries
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paginations" id="na_datatable_paginate">
                                <ul class="pager float-end">
                                #PAGINATION#
                                </ul>
                            </div>
                        </div>
                    </div>`;

    $(".datacard-search-results-count").html(`Showing <strong>${trimStart + 1} - ${last_index} </strong>of <strong>${total_count} </strong>entries`);
    var clicked_page = state.page;

    var maxLeft = (state.page - Math.floor(state.window / 2))
    var maxRight = (state.page + Math.floor(state.window / 2))

    if (maxLeft < 1) {
        maxLeft = 1
        maxRight = state.window
    }

    if (maxRight > pages) {
        maxLeft = pages - (state.window - 1)

        if (maxLeft < 1) {
            maxLeft = 1
        }
        maxRight = pages
    }


    $('#pagination-wrapper').html('');

    let pagination_li = '';
    pagination_li += `<li><a role="button" value=${clicked_page - 1} aria-controls="na_datatable" class="pagination-button pager-prev ${(clicked_page == 1) ? 'd-none' : ''}"></a></li>`;
    for (var temp_page = maxLeft; temp_page <= maxRight; temp_page++) {
        pagination_li += `<li><a role="button" aria-controls="na_datatable" aria-page=${temp_page} value=${temp_page} class="pagination-button pager-number ${(clicked_page == temp_page) ? 'active' : ''}">${temp_page}</a></li>`;
    }

    pagination_li += `<li><a role="button" value=${clicked_page + 1} aria-controls="na_datatable" class="pagination-button pager-next ${(clicked_page == maxRight) ? 'd-none' : ''}"></a></li>`;


    bottom_nav = bottom_nav.replace("#PAGINATION#", pagination_li);
    $('#pagination-wrapper').html(bottom_nav);

    // parameterList = new URLSearchParams(address);



    $(document).on('click', '.pagination-button', function () {
        $("#datacard-body").empty()

        state.page = Number($(this).attr('value'))
        // alert(state.page);
        add_getParameters("page", state.page);
        buildCard()
    })

}

function createCard() {

    var datatable = `<div id="datacard-body"></div>`;
    let length_and_search_bar = `<div class="row">`;
    length_and_search_bar += `<div class="col-12 col-md-2 datacard-searchbar me-auto"><label>Show entries</label>
    <select id="na_datacard_length" name="na_datacard_length" class="col-md-2 custom-select custom-select-sm form-control form-control-sm">
    <option value="10">10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="100">100</option>
    </select></div>`;
    length_and_search_bar += `<div class="col-12 col-md-4 datacard-searchbar"><label id="datacard-search-label">Search: </label><input type="text" class="form-control" name="search_datacard" id="search_datacard"></div>`;
    length_and_search_bar += `</div></div>`;

    $("#datacard-body").html('');
    $("#na_datacard").html(length_and_search_bar);

}



function buildCard(Fliteredstate = '') {

    var datatable = `<div id="datacard-body"></div>`;
    $("#datacard-body").html('');
    $("#na_datacard").append(datatable);
    if (Fliteredstate == '')
        Fliteredstate = state;


    var data = pagination(Fliteredstate.querySet, Fliteredstate.page, Fliteredstate.rows);
    var myList = data.querySet;
    // console.log(data);

    if (myList.length == 0) {
        $("#datacard-body").html('No results found..');
        $('#pagination-wrapper').html('');
        return;
    }



    let arr_length;

    let div_datacard_body, div_container, data_div, data_div2, data_info_and_btn, data_btn, data_img_div, data_details_div, action_div;

    let classLists = $("#na_datacard").attr('data-class');

    div_datacard_body = document.createElement("div");
    div_datacard_body.setAttribute("class", classLists);

    let limit = 5;

    $.each(myList, function (index, item) {
        arr_length = item.length;

        limit = (limit < 5) ? arr_length - 1 : limit;

        div_container = document.createElement("div");
        div_container.classList.add('col-xl-6');
        div_container.classList.add('col-lg-6');
        div_container.classList.add('col-md-6');

        data_div = document.createElement("div");
        data_div.classList.add('card-grid-2');
        data_div.classList.add('hover-up');


        data_div2 = document.createElement("div");
        data_div2.classList.add('card-grid-2-image-left');


        // data_img_div.innerHTML = `<img src="${item[1]}" alt="${item[2]}">`;


        data_details_div = document.createElement("div");
        data_details_div.classList.add('card-profile');
        data_details_div.classList.add('pt-10');

        data_info_and_btn = document.createElement("div");
        data_info_and_btn.classList.add('card-block-info');

        data_btn = document.createElement("div");
        data_btn.classList.add('employers-info');
        data_btn.classList.add('mt-15');
        data_btn.classList.add('row');

        // if (item[1].includes('datacard_img')) {
        //     data_img_div = document.createElement("div");
        //     data_img_div.classList.add('img-wrap');

        //     data_img_div.innerHTML = `${item[1]}`;

        //     data_div.appendChild(data_img_div);

        // }


        for (var i = 2; i < limit; i++) {
            if (item[i] != undefined)
                data_details_div.innerHTML += `<p class="title">${item[i]}</p>`;
        }

        for (; i < arr_length; i++) {


            // if (item[i].includes('datacard_btns')) {
            //     data_btn.innerHTML += `${item[i]}`;

            // } else {
            data_info_and_btn.innerHTML += `${item[i]}`;
            //     }
        }


        // action_div = document.createElement("div");
        // action_div.classList.add('action-buttons');
        // action_div.innerHTML = item[i];

        data_div.appendChild(data_div2);
        // data_info_and_btn.appendChild(data_btn);
        data_div.appendChild(data_info_and_btn);

        data_div2.appendChild(data_details_div);
        // data_div.appendChild(action_div);

        div_datacard_body.appendChild(div_container);
        div_container.appendChild(data_div);

        $("#datacard-body").append(div_datacard_body)
    });



    // pageButtons_old(data.pages);
    pageButtons(data.pages, Fliteredstate);

}