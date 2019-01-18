@extends('layouts.admin.admin')
@section('page-title')
    {{ __('company.update') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4>{{ $company->info_box->name }}</h4>
            </div>
        </div>
        <div class="card-box">
            {{ Form::model($company->info_box,['method' => 'PUT', 'url' => route('company.update',compact('company')),"files" => true ]) }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('name',ucfirst(__("validation.attributes.name")),['class' => 'control-label']) }}
                            {{ Form::text('name',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('name'))
                            <span class="text-danger">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('email',ucfirst(__("validation.attributes.email")),['class' => 'control-label']) }}
                            {{ Form::email('email',$company->info_box->emails[0]->email,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('tel',ucfirst(__("validation.attributes.phone")),['class' => 'control-label']) }}
                            {{ Form::tel('tel',$company->info_box->tels[0]->tel,['class'=>'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('tel'))
                            <span class="text-danger">
                                {{ $errors->first('tel') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('fax',ucfirst(__("validation.attributes.fax")),['class' => 'control-label']) }}
                            {{ Form::tel('fax',null,['class'=>'form-control form-floating']) }}
                        </div>
                        @if($errors->has('fax'))
                            <span class="text-danger">
                                {{ $errors->first('fax') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('speaker',ucfirst(__("validation.attributes.speaker")),['class' => 'control-label']) }}
                            {{ Form::text('speaker',null,['class'=>'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('speaker'))
                            <span class="text-danger">
                                {{ $errors->first('speaker') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('licence',ucfirst(__("validation.attributes.licence")),['class' => 'control-label']) }}
                            {{ Form::text('licence',null,['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('licence'))
                            <span class="text-danger">
                                {{ $errors->first('licence') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('turnover',ucfirst(__("validation.attributes.turnover")),['class' => 'control-label']) }}
                            {{ Form::number('turnover',null,['class' => 'form-control form-floating','placeholder'=>'Turnover','required']) }}
                        </div>
                        @if($errors->has('turnover'))
                            <span class="text-danger">
                                {{ $errors->first('turnover') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('taxes',ucfirst(__("validation.attributes.taxes")),['class' => 'control-label']) }}
                            {{ Form::number('taxes',null,['class' => 'form-control form-floating','placeholder'=>'Taxes','required']) }}
                        </div>
                        @if($errors->has('taxes'))
                            <span class="text-danger">
                                {{ $errors->first('taxes') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('ice',ucfirst(__("validation.attributes.ice")),['class' => 'control-label']) }}
                            {{ Form::number('ice',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('ice'))
                            <span class="text-danger">
                                {{ $errors->first('ice') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('address',ucfirst(__("validation.attributes.address")),['class' => 'control-label']) }}
                            {{ Form::text('address',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('address'))
                            <span class="text-danger">
                                {{ $errors->first('address') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('build',ucfirst(__("validation.attributes.build")),['class' => 'control-label']) }}
                            {{ Form::number('build',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('build'))
                            <span class="text-danger">
                                {{ $errors->first('build') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('floor',ucfirst(__('validation.attributes.floor')),['class' => 'control-label']) }}
                            {{ Form::text('floor',null,['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('floor'))
                            <span class="text-danger">
                                {{ $errors->first('floor') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('apt_nbr',ucfirst(__('validation.attributes.apt_nbr')),['class' => 'control-label']) }}
                            {{ Form::number('apt_nbr',null,['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('apt_nbr'))
                            <span class="text-danger">
                                {{ $errors->first('apt_nbr') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('zip',ucfirst(__("validation.attributes.zip")),['class' => 'control-label']) }}
                            {{ Form::number('zip',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('zip'))
                            <span class="text-danger">
                                {{ $errors->first('zip') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('city_id', ucfirst(__('validation.attributes.city')),['class' => 'control-label']) }}
                            <select name="city" id="city" title="city" class="form-control form-floating">
                                @foreach(\App\City::all() as $city)
                                    <option value="{{ $city->id }}"
                                            @if(old('city') == $city->id)
                                                selected
                                                @elseif($company->info_box->city_id == $city->id)
                                                    selected
                                                @endif
                                            >{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('city'))
                            <span class="text-danger">
                                {{ $errors->first('city') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>pièce justificatif</label>
                        <div id="filesinput">
                            <!-- Our File Inputs -->
                            <div class="wrap-custom-file">
                                <input type="file" name="brand" id="image1" accept=".gif, .jpg, .png"/>
                                @if($company->info_box->brand)
                                    <label for="image1"
                                           class="covimgs"
                                           style="background-image: url('{{ asset('storage/' . $company->info_box->brand) }}');">

                                        <span>Select justify image</span>
                                        <i class="fa fa-plus-circle"></i>
                                    </label>
                                @else
                                    <label for="image1"
                                           class="covimgs"
                                           style="background-image: url('{{ asset('img/placeholder.jpg') }}');">
                                        <span>Select justify image</span>
                                        <i class="fa fa-plus-circle"></i>
                                    </label>
                                @endif
                            </div>
                            <!-- End Page Wrap -->
                        </div>
                        <small class="help-block">Allowed images: jpg, gif, jpeg, png. Maximum 1 image only.</small>
                        @if ($errors->has('brand'))
                            <div class="help-block">{{ $errors->first('brand') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{ __("admin.update") }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
