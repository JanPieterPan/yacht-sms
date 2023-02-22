@extends('dashboard.layout')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Content texts</h1>
                    @include('dashboard.notifications')
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form class="row" action="{{ route('texts.store') }}" method="post">
                @csrf
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Main</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Intro</label>
                                <textarea class="form-control" name="intro">{{ $texts->intro ?? "" }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>About</label>
                                <textarea class="form-control" name="about">{{ $texts->about ?? "" }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                                <textarea class="form-control" name="details">{{ $texts->details ?? "" }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Mission block</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="mission_title" value="{{ $texts->mission_title ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label>Text</label>
                                <textarea class="form-control" name="mission">{{ $texts->mission ?? "" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Additional</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Slider block title</label>
                                <input type="text" class="form-control" name="slider" value="{{ $texts->slider ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label>ISO standards block title</label>
                                <input type="text" class="form-control" name="iso" value="{{ $texts->iso ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label>Methods block title</label>
                                <input type="text" class="form-control" name="method_title" value="{{ $texts->method_title ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label>Methods block subtitle</label>
                                <input type="text" class="form-control" name="method_subtitle" value="{{ $texts->method_subtitle ?? "" }}">
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">OMS block</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="oms_title" value="{{ $texts->oms_title ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label>Text</label>
                                <textarea class="form-control" name="oms">{{ $texts->oms ?? "" }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>
@endsection

