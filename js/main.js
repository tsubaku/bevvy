//<!-- AJAX block -->
function XmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}


function ajax(param) {
    if (window.XMLHttpRequest) req = new XmlHttp();
    method = (!param.method ? "POST" : param.method.toUpperCase());

    if (method == "GET") {
        send = null;
        param.url = param.url + "&ajax=true";
    } else {
        send = "";
        for (var i in param.data) send += i + "=" + param.data[i] + "&";
        // send=send+"ajax=true"; // send success
    }

    req.open(method, param.url, true);
    if (param.statbox) document.getElementById(param.statbox).innerHTML = '<img src="./img/wait.gif">';
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(send);
    req.onreadystatechange = function () {
        if (req.readyState == 4 && req.status == 200) //if response OK
        {
            if (param.success) param.success(req.responseText);
        }
    }
}

//<!-- end AJAX block -->


/**
 * Send a request to get data from the server. Process and display data.
 * @param param
 */
function getData(param) {
    let paginate = document.getElementById('span-paginate').innerHTML;  //current page
    let choice = document.getElementById('choice').value;               //selected search field
    let search = document.getElementById('search').value;               //search phrase

    let sorting = document.getElementsByName('sorting');            //sorting
    let sortBy = ''
    for (const variant of sorting) {
        if (variant.checked) {
            sortBy = variant.value
        }
    }

    //get the required page number
    if (param === undefined) {
        paginate = 1
    }
    if (param === 'first') {
        paginate = 1
    }
    if (param === 'previous') {
        paginate = --paginate
    }
    if (param === 'next') {
        paginate = ++paginate
    }

    //Disable button `Previous`, if page = 1
    previousDisable(paginate)

    //Send data to the server
    ajax({
        url: "core.php",
        type: "POST",
        statbox: "status",
        data:
            {
                choice: choice,
                search: search,
                paginate: paginate,
            },
        success: function (data) {
            //SUCCESS AJAX
            console.log("getTask ok! \n");
            document.getElementById("status").innerHTML = ''; 	//remove wait icon
            document.getElementById("div-pagination").style.visibility = 'visible';//make the results div visible
            document.getElementById("span-paginate").innerHTML = JSON.parse(data).paginate;

            let div = document.getElementById("result")
            div.innerHTML = '';	//remove old result

            let res = JSON.parse(data).result
            let groupingData = groupByDate(res) //to sort data

            //Adding Similar numbers
            for (let key in groupingData) {
                console.log("Key: " + key + " Value: " + JSON.stringify(groupingData[key], null, 4));
                let h4 = document.createElement("h4")
                let node = document.createTextNode("Similar number: " + key)
                h4.appendChild(node)
                div.appendChild(h4)

                let similars = groupingData[key]

                if (sortBy) {
                    let direction = ''
                    let reversSort = document.getElementById("reverse-sort").checked
                    if (reversSort) {
                        console.log("!+")
                        direction = "-"
                    } else {
                        console.log("!-")
                    }
                    similars.sort(dynamicSort(direction + sortBy))
                }

                //Adding rows
                for (let key2 in similars) {
                    let p = document.createElement('p');
                    p.innerHTML = '<span class="font-weight-bold">Whisky Id: </span>' + similars[key2].id +
                        '<span class="font-weight-bold"> Whisky Name: </span>' + similars[key2].name +
                        '<span class="font-weight-bold"> Whisky strength: </span>' + similars[key2].strength
                    div.appendChild(p);
                }
            }
        },
        error: function (error) {
            //ERROR AJAX
            console.log("Error AJAX" + JSON.stringify(error, null, 4));
            document.getElementById("status").innerHTML = "<pre>" + data + "</pre>";
        }
    })

}

/**
 * Disable button `Previous`, if page = 1.
 * @param paginate
 */
function previousDisable(paginate) {
    const button = document.getElementById('a-previous');
    if (paginate <= 1) {
        button.disabled = true;
    } else {
        button.disabled = false;
    }
}

/**
 * Grouping data by `Similar number`
 * @param arr
 * @returns {*}
 */
function groupByDate(arr) {
    //collapse array into temporary object, with similar_number as keys
    const temp = arr.reduce((acc, elem) => {
        //extract similar_number
        const similar = elem.similar_number;
        //if similar_number key is not yet in the object, write an empty array there
        if (!acc[similar]) {
            acc[similar] = [];
        }
        //put the current element into the appropriate array
        acc[similar].push(elem);
        return acc;
    }, {});

    return temp;
}

/**
 * Sorting inside Similar numbers
 * @param property
 * @returns {function(*, *)}
 */
function dynamicSort(property) {
    var sortOrder = 1;
    if (property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a, b) {
        //next line works with strings and numbers, and you may want to customize it to your needs
        var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
        return result * sortOrder;
    }
}