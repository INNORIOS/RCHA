<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Info </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    body{
        margin:0;
        padding:0;
        font-family: "Helvitica",sans-serif;
    }
    #filters{
        margin-left: 10%;
        margin-top: 2%;
        margin-bottom:2%
    }
    <div id="filters">
        <span> Select how to sort &nbsp;  </span>
<select name="fetchval" id="fetchval"></select>
<option value="" disabled="" selected="">Select filter</option>
<option value="">first_name</option>
<option value="">Email</option>
<option value="">created date</option>

    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>first_name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>place locatoin</th>
                    <th>Token id</th>
                    <th>Amount</th>
                    <th>created date</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>


    </div>
</body>
</html>