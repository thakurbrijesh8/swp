<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-buildings"></i> Property Registration</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Property Registration</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="property_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="property_form1_pdf_form" action="Property/generate_form1" method="post">
    <input type="hidden" id="property_id_for_property_form1" name="property_id_for_property_form1">
</form>
<form target="_blank" id="property_certificate_pdf_form" action="Property/generate_certificate" method="post">
    <input type="hidden" id="property_id_for_certificate" name="property_id_for_certificate">
</form>