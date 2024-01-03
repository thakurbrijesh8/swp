<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fas fa-film"></i> Travel Agent Registration</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Travel Agent Registration</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="travelagent_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="travelagent_form_pdf_form" action="travelagent/generate_form" method="post">
    <input type="hidden" id="travelagent_id_for_travelagent_form" name="travelagent_id_for_travelagent_form">
</form>
<form target="_blank" id="travelagent_certificate_pdf_form" action="travelagent/generate_certificate" method="post">
    <input type="hidden" id="travelagent_id_for_certificate" name="travelagent_id_for_certificate">
</form>