@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row my-3">
        <h5 class="col-sm-4 mt-3">Detail Survey</h5>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <a href="/dashboard/surveys" class="btn btn-success mb-3"> <span data-feather="arrow-left"></span> Back to
                All Survey</a>
            <a href="/dashboard/surveys/{{ $survey->id}}/edit" class="btn btn-warning mb-3"> <span
                    data-feather="edit"></span> Edit</a>
            <form action="/dashboard/surveys/{{ $survey->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger mb-3"
                    onclick="return confirm('Are you sure to delete this survey?')"><span
                        data-feather="x-circle"></span> Delete</button>
            </form>
            <div class="row">
                <div class="col-md text-center">
                    @if ($survey->imageAssets)
                    <img id="unsplashImage" src="{{ asset('storage/' . $survey->imageAssets) }}"
                        class="img-fluid img-thumbnail" alt="{{ $survey->name }}">
                    @else
                    <img id="unsplashImage" src="{{ $survey->imageAssets }}" class="img-fluid img-thumbnail"
                        alt="{{ $survey->name }}">
                    @endif
                </div>
                <div class="col-md">
                    <h1 class="mb-2">{{ $survey->name }}</h1>
                    <p class="my-0">Price start from <b>Rp. {{ number_format($survey->price / 1, 0) }},-</b></p>
                    <p class="mt-0">Estimasi Pengerjaan {{ $survey->workDuration }} hari kerja</p>
                    <p>
                        {{-- Added By Staff <a href="" class="text-decoration-none">{{ $survey->employee->name }}</a>
                        --}}
                        in <a href="/categories/{{ $survey->category->slug }}" class="text-decoration-none">{{
                            $survey->category->name
                            }}</a>
                    </p>
                    <table class="table">
                        <tr>
                            <td>Kategori</td>
                            <td>: {{ $survey->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Berat</td>
                            <td>: {{ $survey->weight }} Kg</td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            <td>: {{ $survey->stock }} Unit</td>
                        </tr>
                    </table>
                    <h5>Deskripsi</h5>
                    <p>{!! $survey->description !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection