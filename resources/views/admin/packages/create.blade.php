@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.package.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.packages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.package.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="url">{{ trans('cruds.package.fields.url') }}</label>
                <textarea class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" name="url" id="url" required>{{ old('url') }}</textarea>
                @if($errors->has('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="passcode">{{ trans('cruds.package.fields.passcode') }}</label>
                <input class="form-control {{ $errors->has('passcode') ? 'is-invalid' : '' }}" type="text" name="passcode" id="passcode" value="{{ old('passcode', '') }}" required>
                @if($errors->has('passcode'))
                    <span class="text-danger">{{ $errors->first('passcode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.passcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.package.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ old('author_id') == $id ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <span class="text-danger">{{ $errors->first('author') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" required {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_active">{{ trans('cruds.package.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.package.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection