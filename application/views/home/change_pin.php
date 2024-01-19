<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-key"></i> Change Pin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Change Pin</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: none; text-align: center;">Change Pin Form</h3>
                    </div>
                    <form role="form" id="change_pin_form" name="change_pin_form" autocomplete="off">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Current Pin</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="current_pin_for_change_pin" name="current_pin_for_change_pin" placeholder="Enter Current Pin !"
                                           onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));
                                                   checkValidationForPin('pin-change', 'current_pin_for_change_pin', currentPinValidationMessage);"
                                           maxlength="6">
                                    <div class="input-group-prepend eye-class" onclick="Home.listview.hideShowPassword($(this), 'current_pin_for_change_pin');">
                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                                <span class="error-message error-message-pin-change-current_pin_for_change_pin"></span>
                            </div>
                            <div class="form-group">
                                <label>New Pin</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="new_pin_for_change_pin" name="new_pin_for_change_pin" placeholder="Enter New Pin !"
                                           onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));
                                                   checkValidationForPin('pin-change', 'new_pin_for_change_pin', newPinValidationMessage);"
                                           maxlength ="6">
                                    <div class="input-group-prepend eye-class" onclick="Home.listview.hideShowPassword($(this), 'new_pin_for_change_pin');">
                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                                <span class="error-message error-message-pin-change-new_pin_for_change_pin"></span>
                            </div>
                            <div class="form-group">
                                <label>Retype Pin</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="retype_new_pin_for_change_pin" name="retype_new_pin_for_change_pin" placeholder="Enter Retypes Pin !"
                                           onkeyup="checkNumeric($(this));" onblur="checkNumeric($(this));"
                                           maxlength ="6">
                                    <div class="input-group-prepend eye-class" onclick="Home.listview.hideShowPassword($(this), 'retype_new_pin_for_change_pin');">
                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                    </div>
                                </div>
                                <span class="error-message error-message-pin-change-retype_new_pin_for_change_pin"></span>
                            </div>
                            <div>
                                <button type="button" id="submit_btn_for_change_pin" class="btn btn-sm btn-success" onclick="Home.listview.changePin($(this));" style="margin-right: 5px;"><i class="fas fa-save"></i>&nbsp; Submit</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="Home.listview.resetChangePinForm();">Clear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>