<html>
    <head>
        <title>Form-II</title>
        <style type="text/css">
            body {
                font-family: serif;
                font-size: 12px;
            }
            table.CompanyDetails, td {
                width: 100%;
                border: 1px solid black;
                border-collapse: collapse;
            }
            td.first-column{
                width: 6%;
                text-align: center;
            }
            td.second-column{
                width: 43%;
            }
            td.third-column{
                width: 43%;
            }
            td.table-first-column{
                width: 5.45%;
                text-align: center;
            }
            td.table-second-column{
                width: 25%;
            }
            td.table-third-column{
                width: 25%;
            }
            td.table-forth-column{
                width: 20%;
            }
            td.table-fifth-column{
                width: 25%;
            }
            td.single-second-column{
                width: 94%;
            }
            table.CompanyDetails td{
                height: 60px;
                padding: 3px;
            }
            td.declaration-number{
                border: none;
                width: 5%;
                vertical-align: text-top;
            }
            td.declaration{
                border: none;
                width: 100%;
            }
            td.border-none{
                border: none;
            }
        </style>
    </head>
    <body>
        <div style="font-size: 14px; text-align: center;font-weight: bold;">FORM-II</div>
        <div style="text-align: center;font-weight: bold;">(Under Goa, Daman, and Diu Shops and Establishments Rule, 1975)</div>
        <div style="text-align: center;font-weight: bold;">( See Rule 5 )</div>
        <div style="font-size: 14px; text-align: center; margin-top: 10px;font-weight: bold;">Registration Certificate of Establishment</div>
        <div style="font-size: 14px; text-align: center; margin-bottom: 10px;"></div>

        <div style="font-size: 14px; text-align: left; margin-bottom: 10px;word-spacing: 10px;margin-top: 40px;font-weight: bold;">1. Registration Number &emsp; <div style="margin-left: 320px;margin-top: -15px;">-- <?php echo $shop_data['s_registration_no']; ?></div></div>
        <div style="font-size: 14px; text-align: left; margin-bottom: 10px;word-spacing: 10px;margin-top: 20px;font-weight: bold;">2. Name of Establishment  <div style="margin-left: 320px;margin-top: -15px;">-- <?php echo $shop_data['s_name']; ?></div></div>
        <div style="font-size: 14px; text-align: left; margin-bottom: 10px;word-spacing: 10px;font-weight: bold;margin-top: 20px;">3. Postel Address of Establishment  <div style="margin-left: 320px;margin-top: -15px;">--  <?php echo $shop_data['s_door_no']; ?>,<?php echo $shop_data['s_street_name']; ?>,<?php echo $shop_data['s_location']; ?></div></div>
    <div style="font-size: 14px; text-align: left; margin-bottom: 10px;word-spacing: 10px;font-weight: bold;margin-top: 20px;">4. Name of Employer  <div style="margin-left: 320px;margin-top: -15px;">--  <?php echo $shop_data['s_employer_name']; ?></div></div>
    <div style="font-size: 14px; text-align: left; margin-bottom: 10px;word-spacing: 10px;font-weight: bold;margin-top: 20px;">5. Nature of Business  <div style="margin-left: 320px;margin-top: -15px;">--  <?php echo $shop_data['s_nature_of_business']; ?></div></div>
    <div style="font-size: 14px; text-align: left; margin-bottom: 10px;margin-top: 40px;margin-left:50px;font-weight: bold;">It is hereby certified that<div style="border-bottom:1px solid;margin-left: 185px;margin-top: -20px;width:350px;">&nbsp;</div><div style="margin-left: 540px;margin-top: -20px;">has been</div></div>
    <div style="font-size: 14px; text-align: left; margin-bottom: 10px;word-spacing: 7px;font-weight: bold;">Registered as<div style="border-bottom:1px solid;margin-left: 320px;margin-top: -20px;width:170px;">&nbsp;</div><div style="margin-left: 250px;margin-top: -20px;">this day</div><div style="border-bottom:1px solid;margin-left: 560px;margin-top: -20px;width:100px;">&nbsp;</div><div style="margin-left: 500px;margin-top: -20px;">of 200</div><div style="border-bottom:1px solid;margin-left: 120px;margin-top: -20px;width:100px;">&nbsp;</div></div>
    <div style="font-size: 14px; text-align: right; margin-bottom: 5px;"><img src="<?php echo DOC_PATH; ?>sign_and_stamp/labour_stemp.png" height="100px" width="100px"></div>
    <div style="font-size: 14px; text-align: right; margin-bottom: 5px;margin-top:20px;font-weight: bold;">Signature of Inspector</div>
    <div style="font-size: 14px; text-align: left; margin-bottom: 10px;word-spacing: 10px;margin-top: 0px;font-weight: bold;">Seal </div>
</body>
</html>