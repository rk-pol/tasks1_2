$(document).ready(function(){
    checkLS();
    $('ul > li').on('click', function(e) {
        markCategory(this);
        setSortOptDefault();
        var category_name = $(this).attr('name');
        var path = '/' + category_name + '/all';
        var settings = {
            type : 'GET',
            contentType: "application/json",
            url : path, 
                success:function(response){
                    //
                    // console.log(response)
                    if (response.length > 0) {
                        setLocation(path, null);
                        setLS('category', category_name);
                        setLS('sort_value', 'name_asc');
                        displayData(response);
                    }
                }
            }   
        sendRequest(settings); 
    })
    //
    $('.prod-sort > select').on('change', function() {
        var sort_by = $(this).find(':selected').val();
        var category_name = $('li.active').attr('name');
        if (category_name == undefined) {
            category_name = 'all';
        }
        var path = '/' + category_name + '/all';
        sort_data = splitSortOption(sort_by);

        var settings = {
            type : 'GET',
            contentType: "application/json",
            url : path, 
            data : {
                'order_name' : sort_data[0],
                'order_opt' : sort_data[1]
            },
            success:function(response){
                //
                // console.log('success', response)
                if (response.length > 0) {
                    setLS('sort_value', sort_by);
                    setLocation(path, sort_data);
                    displayData(response);
                }
            }
        }   
        sendRequest(settings); 
    })
    //
    $('body').on('click', '.btn-buy', function() {
        var current_location = window.location.href;
        var product_id = $(this).attr('data_id');
        var path = '/id/' + product_id;
        var settings = {
            type : 'GET',
            contentType: "application/json",
            url : path,
            success:function(response){
                if (response) {
                    // console.log(current_location);
                    replaceLocation(current_location);
                    addProductToModal(response)
                }
            }
        }   
        sendRequest(settings);
        $('.modal').addClass('modal-active');
    })
    $('#modal-clear').on('click', function() {
        $('.modal-products').html('');
    })
})

/* Functions */
function sendRequest(settings) {
    $.ajax(settings)
        .done(function(response) {
            console.log('Success');
        })
        .fail(function(response) {
            console.log('Fail');
        })
}
function displayData(response) {
    var html_text = '';
    
    //Clear div
    $('.prod').html('');

    html_text += '<div class="prod-items flex dr-col">';
    for (var count in response) {
        html_text += '<div class="prod-item flex jst-btw al-it-c">'; 
        html_text += '<div class="prod-item-name flex">' + response[count]['name'] + '</div>';
        html_text += '<div class="prod-item-price">' + response[count]['price'] + ' USD</div>';
        html_text += '<div class="btr-wrapper flex jst-c"><button class="btn-buy" data-toggle="modal" data-target="#modal" data_id="' + response[count]['id'] + '" name="buy">Купить</button></div>';
        html_text += '</div>';     
    }
    html_text += '</div>';

    $('.prod').append(html_text);
}
function markCategory(elem) {
    $('li').removeClass('active');

    $(elem).addClass('active');
}
function splitSortOption(sort_by) {
    var sort_data = sort_by.split('_');
    return sort_data;
}
function setSortOptDefault(sort_value) {
    if (sort_value == undefined) {
        $('.prod-sort').find('option[value="name_asc"]').prop('selected','selected');
    }
    $('.prod-sort').find('option[value="' + sort_value + '"]').prop('selected','selected');
}
function setLocation(uri, sort_data){
    var location = '';
    if (uri) {
        location += uri;
    } 
    if (sort_data) {
        location = '?' + sort_data[0] + '=' + sort_data[1];
    }
    history.pushState(null, null, location);
}
function replaceLocation(location) {
    history.replaceState(null, null, location);
}
function addProductToModal(product) {
    var html_text = '';

    html_text += '<div class="modal-product flex jst-btw">'
    html_text += '<div>' + product['name'] + '</div>';
    html_text += '<div>' + product['price'] + ' USD</div>';
    html_text += '</div>'

    $('.modal-products').append(html_text);
}
function setLS(name, value) {
    if (getLS(name)) {
        deleteLS(name);
    }
    localStorage.setItem(name, value);
}
function getLS(name) {
   return localStorage.getItem(name);
}
function deleteLS(name) {
    localStorage.removeItem(name);
}
function clearLS() {
    localStorage.clear();
}
function checkLS() {
    var category = getLS('category');
    var sort_value = getLS('sort_value');
    if (category) {
        var elem = $('li[name="' + category + '"]');
        markCategory(elem);
    }
    if (sort_value) {
        setSortOptDefault(sort_value);
    }
}