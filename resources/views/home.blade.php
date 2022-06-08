@extends('layouts.main')

@section('container')
<main class="container">
	{{-- Buat hero / banner awal --}}
	<div class="container col-xxl-8 px-4 py-5">
		<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
			<div class="col-10 col-sm-8 col-lg-6">
				<img src="/img/sofa1.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700"
					height="500" loading="lazy">
			</div>
			<div class="col-lg-6">
				<h1 class="display-5 fw-bold lh-1 mb-3">Selamat datang di<br /> OMEGA ART</h1>
				<p class="lead">Omega Art merupakan perusahaan yang bergerak dibidang pengerjaan dan pemasangan produk
					interior dan eksterior untuk bangunan anda.</p>
				<div class="d-grid gap-2 d-md-flex justify-content-md-start">
					<a href="/shop"><button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Toko</button></a>
					<a href="/about"><button type="button"
							class="btn btn-outline-secondary btn-lg px-4">Info</button></a>
				</div>
			</div>
		</div>
	</div>

	<div class="container marketing">
		<div class="row">
			<h1 class="text-center mb-5">Layanan</h1>
			<div class="col-lg-3 text-center ">
				<i class="bi bi-chat-dots-fill" style="font-size: 3em;"></i>
				<h5>Konsultasi gratis</h5>
				<p>Konsultasikan produk dan model yang anda inginkan</p>
			</div><!-- /.col-lg-3 text-center -->
			<div class="col-lg-3 text-center">
				<i class="bi bi-hand-thumbs-up-fill" style="font-size: 3em;"></i>
				<h5>Garansi setelah pembelian</h5>
				<p>Garansi pemasangan, pelayanan dan penggantian suku cadang.</p>
			</div><!-- /.col-lg-3 text-center -->
			<div class="col-lg-3 text-center">
				<i class="bi bi-star-fill" style="font-size: 3em;"></i>
				<h5>Produk berkualitas</h5>
				<p>Produk terjamin dan berkualitas.</p>
			</div><!-- /.col-lg-3 text-center -->
			<div class="col-lg-3 text-center">
				<i class="bi bi-geo-alt-fill" style="font-size: 3em;"></i>
				<h5>Gratis survey di area lokalFree Survey in Local Area</h5>
				<p>Gratis survey di Kota Malang dan sekitarnya.</p>
			</div><!-- /.col-lg-3 text-center -->
		</div><!-- /.row -->

		<hr class="featurette-divider">

		<div class="row" id="shop">
			<h1 class="text-center my-3">Toko</h1>
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
				@foreach ($products as $item)
				<div class="col-md-4 mb-3">
					<div class="card shadow-sm">
						<a id="imageLink" href=""><img id="unsplashImage"
								src="{{ asset('storage/' . $item->imageAssets) }}" class="card-img-top"
								alt="{{ $item->category->name }}"></a>
						<div class="card-body">
							<h5 class="card-title">{{ $item->name }}</h5>
							<small class="text-muted">idalam Kategori {{ $item->category->name }}</small>
							<small class="text-muted p-1 border rounded" style="font-size: 0.8em">{{
								$item->productAvailability->availability
								}}</small>
							<p class="card-text pt-2">{{ $item->excerpt }}</p>
							<a href="/products/{{ $item->slug }}" class="btn btn-primary">Lihat produk</a>
							<small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="d-flex justify-content-center my-4">
				{{ $products->links() }}
			</div>
		</div>
		<hr class="featurette-divider">
	</div>
</main>

@endsection