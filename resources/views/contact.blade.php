@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row">
        <div class="col-lg-6 py-4 mb-3">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.208276131849!2d112.62149361432846!3d-7.977412881741145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62826cc8ab5b9%3A0xda169d1d96420abc!2sOMEGA%20ART%20MALANG%20SHOWROOM!5e0!3m2!1sen!2sid!4v1651852236092!5m2!1sen!2sid"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" class="text-center"></iframe>
            <small class="p-0 m-0">*Location of Our Showroom</small>
        </div>
        <div class="col-lg-6">
            <h2 class="py-4">Our Location</h2>
            <div class="row">
                <div class="col-sm-6 table-responsive">
                    <h5>Head Office</h5>
                    <table class="table table-sm">
                        <tr>
                            <td>Alamat</td>
                            <td>: Malang, Jawa Timur</td>
                        </tr>
                        <tr>
                            <td>Telephone</td>
                            <td>: 081 234 5678</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6 table-responsive">
                    <h5>Showroom</h5>
                    <table class="table table-sm">
                        <tr>
                            <td>Alamat</td>
                            <td>: Malang, Jawa Timur</td>
                        </tr>
                        <tr>
                            <td>Telephone</td>
                            <td>: 081 234 5678</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <hr class="featurette-divider">
    <div class="row">
        <div class="col-md-3 mt-2">
            <h5>Contact us</h5>
            <table class="table table-sm">
                <tr>
                    <td><i class="bi bi-envelope" style="font-size: 1em;"></i> omegaart@gmail.com</td>
                </tr>
                <tr>
                    <td><i class="bi bi-telephone" style="font-size: 1em;"></i> +6285123456789</td>
                </tr>
                <tr>
                    <td><i class="bi bi-instagram" style="font-size: 1em;"></i> omegaart48</td>
                </tr>
                <tr>
                    <td><i class="bi bi-facebook" style="font-size: 1em;"></i> OMEGA ART Malang</td>
                </tr>
            </table>
        </div>
    </div>

</div>
@endsection