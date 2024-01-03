<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark"><i class="nav-icon fas fa-film"></i> Hotel Registration</h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="main#home">Home</a></li>
                    <li class="breadcrumb-item active">Hotel Registration</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid" id="hotelregi_form_and_datatable_container">
    </div>
</section>
<form target="_blank" id="hotelregi_form1_pdf_form" action="hotelregi/generate_formII" method="post">
    <input type="hidden" id="hotelregi_id_for_hotelregi_formII" name="hotelregi_id_for_hotelregi_formII">
</form>
<form target="_blank" id="hotelregi_certificate_pdf_form" action="hotelregi/generate_certificate" method="post">
    <input type="hidden" id="hotelregi_id_for_certificate" name="hotelregi_id_for_certificate">
</form>