<!DOCTYPE html>
<html lang="en">

<head>
    <title>Test task 2</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="js/main.js"></script>
</head>

<body>
<div class="container-fluid">
    <h1>Test task 2</h1>
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="choice">Filter</label>
            <select name="choice" id="choice">
                <option value="" selected>none</option>
                <option value="id">Id</option>
                <option value="name">Name</option>
                <option value="strength">Strength</option>
            </select>
            Like <input id="search" name="search" type="text" title="search"/>
        </div>
        <div class="col-md-6">
            <div class="sorting">
                <p>Sorting inside Similar numbers</p>
                <input type="radio" id="sorting1" name="sorting" value="id" checked>
                <label for="html">Id</label><br>
                <input type="radio" id="sorting2" name="sorting" value="name">
                <label for="css">Name</label><br>
                <input type="radio" id="sorting3" name="sorting" value="strength">
                <label for="javascript">Strength</label>
            </div>
            <label for="reverse-sort">Sort in reverse order</label>
            <input id="reverse-sort" name="reverse-sort" type="checkbox"
                   title="reverse-sort"/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <input type="button" value="Get result" onclick="getData();" class="m-3">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>Result</h3>
            <div id="result" class="col-md-12">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="div-pagination">
                <p>Page <span id="span-paginate"></span></p>
                <ul class="pagination">
                    <input type="button" value="First Page" onclick="getData('first');" class="m-3" id="a-first">
                    <input type="button" value="Previous" onclick="getData('previous');" class="m-3" id="a-previous">
                    <input type="button" value="Next" onclick="getData('next');" class="m-3" id="a-next">
                    <!--
                    <li class="pagination">
                        <a href="javascript:void(0)" onclick="getData('first');" id="a-first"
                           title="First">First Page</a>
                    </li>
                    <li class="pagination">
                        <a href="javascript:void(0)" onclick="getData('previous');" id="a-previous"
                           title="Previous">Previous</a>
                    </li>
                    <li class="pagination">
                        <a href="javascript:void(0)" onclick="getData('next');" id="a-next"
                           title="Next">Next</a>
                    </li>
                    -->
                </ul>
            </div>
        </div>
    </div>


    <div id="status"></div>

</div>


</body>

</html>