<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fa fa-buildings"></i> Periodical Return</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Periodical Return</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="periodicalreturn_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="periodicalreturn_form1_pdf_form" action="periodicalreturn/generate_form1" method="post">
    <input type="hidden" id="periodicalreturn_id_for_periodicalreturn_form1" name="periodicalreturn_id_for_periodicalreturn_form1">
</form>
<form target="_blank" id="periodicalreturn_certificate_pdf_form" action="periodicalreturn/generate_certificate" method="post">
    <input type="hidden" id="periodicalreturn_id_for_certificate" name="periodicalreturn_id_for_certificate">
</form>