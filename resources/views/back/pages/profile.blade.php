@extends('back.layout.pages-layout')
@section('pageTitle', 'Profile')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Hồ sơ</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                @if (auth()->user()->type === 'superAdmin')
                                    <li style="margin-right: 4px" class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">Trang chủ > </a>
                                    </li>
                                    <span style="color: blue;font-weight: 600">Hồ sơ</span>
                                @endif
                            </ol>
                        </nav>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @livewire('admin.profile')
@endsection
