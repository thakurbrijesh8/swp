<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-buildings"></i> Construction Permission </h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Construction Permission</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="construction_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="construction_form1_pdf_form" action="Construction/generate_form1" method="post">
    <input type="hidden" id="construction_id_for_construction_form1" name="construction_id_for_construction_form1">
</form>
<form target="_blank" id="construction_certificate_pdf_form" action="Construction/generate_certificate" method="post">
    <input type="hidden" id="construction_id_for_certificate" name="construction_id_for_certificate">
</form>