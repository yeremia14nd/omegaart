@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="/img/bg_home1.png" width="100%" class="center img-thumbnail text-center" alt="Omega Art">
        </div>
        <div class="col-md-6 align-items-center">
            <h2 class="py-4">Tentang Kami</h2>
            <p>Kami adalah perusahaan yang bergerak di bidang pengerjaan dan pemasangan produk-produk aluminium, kaca,
                interior & exterior window blinds (gorden) dll</p>
        </div>
    </div>

    <hr class="featurette-divider">

    {{-- Projects Example --}}
    <div class="row">
        <h1 class="text-center my-3">Proyek Kami</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <a id="imageLink" href=""><img id="unsplashImage" src="/img/sofa1a.png" class="card-img-top"
                            alt="projects"></a>
                    <div class="card-body">
                        <h5 class="card-title">Project 1</h5>
                        <p class="card-text pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, nobis?
                        </p>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <a id="imageLink" href=""><img id="unsplashImage" src="/img/sofa1a.png" class="card-img-top"
                            alt="projects"></a>
                    <div class="card-body">
                        <h5 class="card-title">Project 2</h5>
                        <p class="card-text pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, nobis?
                        </p>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <a id="imageLink" href=""><img id="unsplashImage" src="/img/sofa1a.png" class="card-img-top"
                            alt="projects"></a>
                    <div class="card-body">
                        <h5 class="card-title">Project 3</h5>
                        <p class="card-text pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, nobis?
                        </p>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <a id="imageLink" href=""><img id="unsplashImage" src="/img/sofa1a.png" class="card-img-top"
                            alt="projects"></a>
                    <div class="card-body">
                        <h5 class="card-title">Project 4</h5>
                        <p class="card-text pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, nobis?
                        </p>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <a id="imageLink" href=""><img id="unsplashImage" src="/img/sofa1a.png" class="card-img-top"
                            alt="projects"></a>
                    <div class="card-body">
                        <h5 class="card-title">Project 5</h5>
                        <p class="card-text pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, nobis?
                        </p>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <a id="imageLink" href=""><img id="unsplashImage" src="/img/sofa1a.png" class="card-img-top"
                            alt="projects"></a>
                    <div class="card-body">
                        <h5 class="card-title">Project 6</h5>
                        <p class="card-text pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, nobis?
                        </p>
                        <small class="text-muted">Lorem ipsum dolor sit amet.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="featurette-divider">

</div>
@endsection